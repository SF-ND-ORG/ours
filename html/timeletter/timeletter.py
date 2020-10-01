# -*- coding: UTF-8 -*-
import pymysql as mdb
import os
from PIL import Image
from PIL import ImageFilter
import requests
import json
import time

send_private_msg='http://114.55.93.225:5700/send_private_msg'
mail_url='http://114.55.93.225/pack/mail/send.php?'

def select(sql): #数据库操作，传入操作字符串，返回套着字典的列表
    con=mdb.connect('localhost','root','PASSWORD','ours',charset='utf8')
    cur=con.cursor()
    cur.execute(sql)
    con.commit()
    con.close()
    des=cur.description
    l=[]
    for row in cur.fetchall():
        dis={}
        for i in range(len(cur.description)):
            dis[cur.description[i][0]]=row[i]
        l.append(dis)
    return l

def send_qq(qq,msg): #发送qq信息，返回是否成功
    try:
        data={'user_id':str(qq),'message':str(msg)}
        print(data)
        r=requests.post(send_private_msg,data=data)
        if r.status_code!=200:
            return False
        s=json.loads(r.text)
        if s['status']!='ok':
            return False
        return True
    except:
        return False

def time2str(t1,t2): #传入两个时间，返回自然语言格式时间差
    t1=time.mktime(time.strptime(str(t1),'%Y-%m-%d %H:%M:%S'))
    t2=time.mktime(time.strptime(str(t2),'%Y-%m-%d %H:%M:%S'))
    t=t2-t1
    if t<0: t=-t
    s=''
    if t>=3600*24:
        s+=str(int(t//(3600*24)))+'天'
        t=t%(3600*24)
    if t>=3600:
        s+=str(int(t//3600))+'小时'
        t=t%3600
    if t>=60:
        s+=str(int(t//60))+'分钟'
        t=t%60
    if t>0:
        s+=str(int(t))+'秒'
    return s

def send_mail(to,name,title,msg): #发送邮件，返回是否成功
    try:
        r=requests.get(mail_url+'to='+to+'&name='+name+'&title='+title+'&msg='+msg)
        if r.status_code!=200:
            return False
        if r.text[0]=='1':
            return True
        else:
            return False
    except:
        return False

def send_letter(dis): #发送信笺，传入字典
    msg=''
    msg+=dis['atc'].replace('\r\n','</br>').replace('\n','</br>')
    msg+='</br></hr>'
    msg+='寄信人：'+dis['from_name']+'</br>'
    msg+='收信人：'+dis['to_name']+'</br>'
    msg+='投递时间：'+str(dis['sendt'])+'</br>'
    msg+='预计送达时间：'+str(dis['recvt'])+'</br>'
    msg+='实际送达时间：'+time.strftime('%Y-%m-%d %H:%M:%S')+'</br>'
    msg+='流淌过的时间：'+time2str(dis['sendt'],time.strftime('%Y-%m-%d %H:%M:%S'))+'</br>'
    msg+='云南师大附中学联网络部</br>suours.com 时光信笺<i>Time Letter</i></br>'
    msg+='没有不必送达的信笺</br>愿你安好'
    mail_status=send_mail(dis['to_mail'],dis['to_name'],'时光信笺',msg)
    qq_status=1
    msg=dis['atc']
    for i in range(0,len(msg),3000):
        qq_status =qq_status & send_qq(dis['to_qq'],msg[i:i+3000])
    msg=''
    msg+='寄信人：'+dis['from_name']+'\n'
    msg+='收信人：'+dis['to_name']+'\n'
    msg+='投递时间：'+str(dis['sendt'])+'\n'
    msg+='预计送达时间：'+str(dis['recvt'])+'\n'
    msg+='实际送达时间：'+time.strftime('%Y-%m-%d %H:%M:%S')+'\n'
    msg+='流淌过的时间：'+time2str(dis['sendt'],time.strftime('%Y-%m-%d %H:%M:%S'))+'\n\n'
    msg+='云南师大附中学联网络部\nsuours.com 时光信笺\nTime Letter\n\n'
    msg+='没有不必送达的信笺\n愿你安好'
    qq_status = qq_status & send_qq(dis['to_qq'],msg)
    print(qq_status,mail_status)
    if qq_status | mail_status:
        sql='update tmlt set status=1 where id='+str(dis['id'])
        select(sql)
        msg='你于'+str(dis['sendt'])+'投递给'+dis['to_name']+'的信已送达\n\n'
        msg+='云南师大附中学联网络部\nsuours.com 时光信笺\nTime Letter\n\n\n'
        msg+='没有不必送达的信笺\n愿你安好'
        if dis['from_qq']!=dis['to_qq']: send_qq(dis['from_qq'],msg)
        if dis['from_mail']!=dis['to_mail']: send_mail(dis['from_mail'],dis['from_name'],'送达',msg.replace('\n','</br>'))
    else:
        sql='update tmlt set status=2 where id='+str(dis['id'])
        select(sql)

def get_bg():
    with open('bg.png','wb') as f:
        f.write(requests.get('https://api.xygeng.cn/bing/1920.php').content)
    
    img=Image.open('bg.png')
    img = img.convert('RGBA')
    x, y = img.size
    for i in range(x):
        for k in range(y):
            color = img.getpixel((i, k))
            color = color[:-1] + (100, )
            img.putpixel((i, k), color)
    img.save('bg.png',quality=50)

def update():
    l=select('select * from tmlt where recvt < NOW() and status=0')
    print("UPDATE",len(l))
    for i in l:
        try:
            send_letter(i)
        except:
            pass

while 1:
    try:
        print(time.asctime(time.localtime()))
        update()
    except:
        pass
    time.sleep(10*60)
