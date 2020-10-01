import bili
import json
from flask_cors import CORS
from flask import Flask,request

app = Flask(__name__)
CORS(app,resources=r"/*")

@app.route('/bilimusic/')
def bilimusic():
    vid=request.args.get("mid")[1:]
    Type=request.args.get("type")
    if Type=="p":
        if vid.find("?")!=-1: vid=vid[:vid.find("?")]
        dic=bili.get_vid(vid)['data']
        l=[]
        for i in dic['pages']:
            x={}
            x["type"]="music"
            x["name"]=dic['title']+"-"+i["part"]
            x["mid"]="Bav"+str(dic['aid'])+"?p="+str(i["page"])
            x["album"]={"name":""}
            x["artist"]=[{"name":dic["owner"]["name"]}]
            l.append(x)
        return json.dumps(l,ensure_ascii=False)
    if Type=="music":
        mvid=vid
        if vid.find("?")!=-1: vid=vid[:vid.find("?")]
        try: src="http://114.55.93.225/MergeMusic/bili/"+bili.get_audio(mvid)
        except: src=""
        dic={
            "src":src,
            "img":"http://114.55.93.225/MergeMusic/bili/"+bili.get_img(vid),
            "lrc":"[00:00.00]木有歌词哦"
        }
        return json.dumps(dic,ensure_ascii=False)
    if Type=="user":
        dic=bili.get_user_fav(vid)
        try: dic=dic['data']['list']
        except: dic=[]
        for ind,i in enumerate(dic):
            x={}
            x["type"]="fav"
            x["name"]=i['title']
            x["mid"]="B"+str(i['id'])
            x["album"]={"name":""}
            x["artist"]=[]
            dic[ind]=x
        mdic=bili.get_up_vid(vid)
        if mdic['data']['page']['count']!=0:
            y={
                "type":"up",
                "name":"投稿(不支持分P自动拆分)",
                "mid":"B"+vid,
                "album":{"name":""},
                "artist":[]
            }
            dic=[y]+dic
        return json.dumps(dic,ensure_ascii=False)
    if Type=="fav":
        dic=bili.get_fav(vid)
        dic=dic['data']['medias']
        for ind,i in enumerate(dic):
            x={}
            x["type"]="p"
            x["name"]=i['title']
            x["mid"]="Bav"+str(i['id'])
            x["album"]={"name":""}
            x["artist"]=[{"name":i['upper']['name']}]
            x['p']=i['page']
            dic[ind]=x
        return json.dumps(dic,ensure_ascii=False)
    if Type=="up":
        dic=bili.get_up_vid(vid)
        dic=dic['data']['list']['vlist']
        for ind,i in enumerate(dic):
            x={}
            x["type"]="p"
            x["name"]=i['title']
            x["mid"]="Bav"+str(i['aid'])
            x["album"]={"name":""}
            x["artist"]=[{"name":i['author']}]
            dic[ind]=x
        return json.dumps(dic,ensure_ascii=False)


app.run(host="0.0.0.0")
