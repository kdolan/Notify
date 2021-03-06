"""
    
    Author: Kevin J Dolan
    Project: Notify
    File Name: notifyServer.py
    Purpose: Get information from the webserver via json and then send out emails.
    Date: 12/29/12
    
"""

from sys import argv
import urllib.request
import json

import time

import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.base import MIMEBase
from email.mime.text import MIMEText
from email import encoders
import os

#Email Credentials
gmail_user = "email"
gmail_pwd = "password"

#Server Key (Used to autenticate to notify server. All traffic should be over https inorder to keep this secure.)
serverKey = "key"

def mail(to, subject, text):
   msg = MIMEText(text)

   msg['From'] = gmail_user
   msg['To'] = to
   msg['Subject'] = subject

    #msg.preable(MIMEText(text))

   
   """ part = MIMEBase('application', 'octet-stream')
   part.set_payload(open(attach, 'rb').read())
   Encoders.encode_base64(part)
   part.add_header('Content-Disposition',
           'attachment; filename="%s"' % os.path.basename(attach))
   msg.attach(part)"""

   mailServer = smtplib.SMTP("smtp.gmail.com", 587)
   mailServer.ehlo()
   mailServer.starttls()
   mailServer.ehlo()
   mailServer.login(gmail_user, gmail_pwd)
   mailServer.sendmail(gmail_user, to, msg.as_string())
   # Should be mailServer.quit(), but that crashes...
   mailServer.close()

def sendNotifications(server):
	
        #load page and add to json array
	print("Checking for new notifications...")
	url = server+"getNotifications.php"+"?serverKey="+serverKey
	page = urllib.request.urlopen(url)
	pageData = page.read()
        #print (pageData)
	if(pageData=="INVALID SERVER KEY"):
           raise InputError("Invalid server key")
	jsonString = str(pageData) #removes first three characters from string. Will always be "b' ".
	jsonString = jsonString[2:]
	jsonString = jsonString.replace("'","")
	notificationData = json.loads(jsonString)
	if(jsonString == "[]"):
           print("    No notifications to send")
           return
	
	
	print("    Sending notifications...")
	sentLst = []
	for row in notificationData:
		recipient = row['email']
		service = row['notificationService']
		message = row['notificationText']
		
		mail(recipient, 'CSH Notifications - '+service, message)
		sentLst.append(row['id'])
		print("      Sent notification id# "+row['id'])
		
	sentLstString = ''
	for id in sentLst:
		if (sentLstString==''):
			sentLstString=id
		else:
			sentLstString = sentLstString+","+id
	url = server+"updateNotifications.php?sentList="+sentLstString+"&serverKey="+serverKey
	print("    Updating server...")
	page = urllib.request.urlopen(url)
	print("    "+str(len(sentLst))+ " notifications sent")
		
	
def main():
    # if no command line arguments specified, prompt for the filename
    # and set debug output to False
    if len(argv) == 3:
        server = argv[1]
        interval = float(argv[2])
        while(True):
           sendNotifications(server)
           print("Waiting for "+str(interval)+" seconds.\n")
           time.sleep(interval)

    # incorrect number of command line arguments
    else:
        
        print("Usage: python3 notifyServer.py [pathToServer refreshIntervalSeconds]")
        print("pathToServer is in this format: https://domain.com/notify/server/ " )
        print("getNotifications.php and updateNotifications.php must be in that directory.")
        print("Ensure server path uses https.")
        print("Refersh interval is number of seconds the program waits before checking the server again.")
        return -1
        


if __name__ == '__main__':
    main()
