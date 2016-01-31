import csv
import json
import re

with open ('C:\\Users\\john\\Desktop\\Scheduler\\test_schedules\\important_stuff2015.csv') as f:
    reader = csv.reader(f)
    array = list(reader)
f.close()
array.pop(0)

dept = []
for row in array:
    dept.append(row[0]) #depts

#print(dept)

d = list(set(dept))
d.sort() #d is a list of all departments with no duplicates
#print(d)

course = []
for row in array:
    course.append(row[1]) #courses

#print(course)

temp = []
course_id = []

for c in course:
    if (c[-2] != "L"):
        temp.append(re.sub("[^0-9]","",c))
    else:
        tempora = (re.sub("[^0-9]","",c))+ "L"
        temp.append(tempora)
for t in temp:
    if (t[-1] != "L"):
        course_id.append(t[:3])
    else:
        tempora = t[:3] + t[-1]
        course_id.append(tempora)

temp1 = []
for i in range(0,len(array)):
    temp1.append({"course":course_id[i]})

days = []
beginTime = []
endTime = []
for row in array:
    days.append(row[3])
    beginTime.append(row[4])
    endTime.append(row[5])

#print(endTime)

section = []
for i in range(0, len(array)):
    if not beginTime[i]:
        section.append({"days":days[i],"beginTime":0,"endTime":0})
    else:
        section.append({"days":days[i],"beginTime":int(float(beginTime[i])),"endTime":int(float(endTime[i]))})
    
title = []
for i in range(0, len(array)):
    title.append(array[i][2])
#print(title)


#test
sec_dept = []
for i in range(0, len(array)):        
    sec_dept.append({"course_id":course_id[i], "dept":dept[i]});

old_dept = "ACCT"
old_course = "200"
count = 0
optimal_dept_sec = []
temp_dept = []
temp_course = []


for i in range(0, len(array)-1):
    if (old_dept == dept[i]):
        if (course_id[i+1] == course_id[i]):
            temp_course.append({"section":section[i],"title":title[i]})
        else:
            temp_course.append({"section":section[i],"title":title[i]})
            temp_dept.append({course_id[i]:temp_course})
            temp_course = []
            #print(course_id[i])
        #print(optimal_dept_sec[i])
    else:
        optimal_dept_sec.append({old_dept:temp_dept})
        old_dept = dept[i]
        temp_dept = []
        if (course_id[i+1] == course_id[i]):
            temp_course.append({"section":section[i],"title":title[i]})
        else:
            temp_course.append({"section":section[i],"title":title[i]})
            temp_dept.append({course_id[i]:temp_course})
            temp_course = []

optimal_dept_sec.append({old_dept:temp_dept})


#for i in range(0, len(d)):
    #print(optimal_dept_sec[i])
    #print(d[i])


full_dept = []
for i in range(0, len(array)):
    full_dept.append({"course_id":course_id[i],"section":section[i],"title":title[i]})
#print(full_dept)

temp = []
temp_lab = []
course = []
for row in array:
    course.append(row[1]) #courses
for c in course:
    temp_lab.append(c[:4])
for t in temp_lab:
    temp.append(re.sub("[0-9]","",t))
#print(temp)

count = 0

temp_depts = []
depts = []
for i in range(0, len(array)):
    if(d[count] != temp[i]):
        depts.append({d[count]:temp_depts})
        count+=1
        temp_depts = []
    temp_depts.append(full_dept[i])
    
depts.append({d[count]:temp_depts})

complete = {}
complete = {"dept":optimal_dept_sec}

count = 0
sec = []
dept_sec = []

for d in depts:
    for key, value in d.items():
        for courses in value:
            sec.append({"course_id":courses["course_id"]})
            #print(d)
        #dept_sec.append({key:sec})
        #sec = []

#print(course_id)
#for c in course_id:
    #print(c)
    
#print(j)
#print(sec["VMP"])

#print(depts[0]["ACCT"][0]["course_id"]) #[dept][name_dept][section]

    #print(test['course_id'])
with open('optimizedSchedule.json', 'w') as f:
    json.dump(complete, f)
