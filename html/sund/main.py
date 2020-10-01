# -*- coding: utf-8 -*-  
import subprocess
import time
import threading
import socket
import urllib.parse
import os
import signal
import json

ct={}

def start_conn(conn,addr): # 处理一个连接请求
    print("New conn")
    s=""
    while True:
        r=conn.recv(1024)
        s+=str(r,encoding="utf-8")
        if len(r)!=1024: break
    
    try:
        s=s.split("\r\n")[0].split(" ")[1]
        if s.find("?")==-1:
            conn.close()
            return
        s=s[s.find("?")+1:]
        dic=urllib.parse.parse_qs(s)
        
    except: conn.close()

    #print("GET ",s,dic)
    print(str(dic))
    with open("log.json","r") as f:
        ct=json.loads(f.read())
    
    if dic["now"][0]+dic["ip"][0] not in ct:
        ct[dic["now"][0]+dic["ip"][0]]=time.strftime("%Y/%m/%d %H:%M:%S", time.localtime())
        if dic["now"][0] in ct:
            ct[dic["now"][0]]+=1
        else:
            ct[dic["now"][0]]=1
    res="HTTP/1.1 200 OK\r\n\r\n"+str(ct[dic["now"][0]])
    conn.send(res.encode('utf-8'))
    conn.close()
    
    with open("log.json","w") as f:
        f.write(json.dumps(ct))

def start_tcp():
    so=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
    so.bind(("",1234))
    so.listen(5)

    print("Server Started\n")
    while True:
        conn,addr=so.accept()
        threading.Thread(target=start_conn,args=(conn,addr)).start()

start_tcp()