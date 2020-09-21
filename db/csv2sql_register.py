#!/usr/bin/env python
#-*- coding: utf-8 -*-
import sys
import re

statuses = []
cathedras = []
devicetypes = []
devicemodels = []

for line in sys.stdin:
    match = re.findall("\".*?\"", line)
    if match:
        cathedra = match[1]
        devicetype = match[2]
        devicemodel = match[3]
        serial = match[4]
        datemanufacture = match[5]
        dateaccept = match[6]
        status = match[9]

        if status not in statuses:
            statuses.append(status)
            print "INSERT INTO statuses (name) VALUES (" + status + ");"

        if cathedra not in cathedras:
            cathedras.append(cathedra)
            print "INSERT INTO cathedras (name) VALUES (" + cathedra + ");"

        if devicetype not in devicetypes:
            devicetypes.append(devicetype)
            print "INSERT INTO devicetypes (name) VALUES (" + devicetype + ");"

        if devicemodel not in devicemodels:
            devicemodels.append(devicemodel)
            print "INSERT INTO devicemodels (typeid, name) VALUES ((SELECT id FROM devicetypes WHERE devicetypes.name=" + devicetype +"), " + devicemodel + ");"

        print "INSERT INTO devices (cathedraid, modelid, statusid, serial, datemanufacture, dateaccept) VALUES ("
        print "    (SELECT id FROM cathedras WHERE cathedras.name =" + cathedra + ")"
        print "    ,(SELECT id FROM devicemodels WHERE devicemodels.name =" + devicemodel + ")"
        print "    ,(SELECT id FROM statuses WHERE statuses.name =" + status + ")"
        print "    ," + serial + "," + datemanufacture + "," + dateaccept + ");"
