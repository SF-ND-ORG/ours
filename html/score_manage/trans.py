import csv, json
#import tkinter as tk
#from tkinter import filedialog
#import os

my_filetypes = [('CSV file', '.csv')]
'''
filePath = filedialog.askopenfilename(initialdir=os.getcwd(),
                                    title="Please select a file(UTF-8):",
                                    filetypes=my_filetypes)
'''
filePath="tmp.csv"

headers=[]
data=[]
with open(filePath,'r',encoding='UTF-8-sig') as f:
    f_raw=csv.reader(f)
    raw=[]
    for i in f_raw:
        raw.append(i)
    headers=raw[0]
    for i in range(1,len(raw)):
        tmp={}
        for j in range(0,len(headers)):
            tmp[headers[j]]=raw[i][j]
        data.append(tmp)
with open('result.json','w',encoding='UTF-8') as f:
    f.write(json.dumps(data))
print(data)
