#!/usr/bin/env python
# -*- coding: utf-8 -*-
#!/usr/bin/python

import time
import MySQLdb
import socket

#socket
s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.bind(("", 2000))
s.listen(1)
sc, addr = s.accept()  
#base de datos
bd = MySQLdb.connect("172.16.68.82","root","ts-IOT_sql2016","iot" )
cursor = bd.cursor()

while True:
 
    recibido = sc.recv(1024)
    if recibido == "close":
        break
#se adiciona a la base de datos
    sql = "INSERT INTO `iot`.`window` (`id`, `status_window`,`rain_sensor`,`light_sensor`,`voice_sensor`,`datetime`) VALUES ('NULL','1','1','1','1','"+time.strftime("%X")+"');"

    try:
       cursor.execute(sql)
       bd.commit()
    except:
       bd.rollback()
    
    print str(addr[0]) + " Cliente dice: ", recibido
    sc.send(recibido)

print "Adios."
sc.close()
s.close()
bd.close()
