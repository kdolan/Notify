from bottle import route, run, template, get, post, request

"""
Web server listens for new notifications.
Notification is parsed, logged and then sent.

This method replaces notify.php. It acomplishes
the same task but does not require a wait time
or a the server to continually query the database.
"""
@get('/notify')
def processNewNotification():
    #Request GET Data and store
    username = request.GET.get('username')
    notification = request.GET.get('notification')
    apiKey = request.GET.get('apiKey')
    #Pcrosess Notifaction - Adapted from notify.php

    return str(username) + " " + str(notification) + " " + str(apiKey)

run(host='media.kevinjdolan.com', port=8080)
