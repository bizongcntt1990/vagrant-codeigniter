#! /bin/sh

###### SETUP ACCESS LOG FILE ############

LOG_FOLDER=/var/log/httpd
ACCESS_LOG=$LOG_FOLDER/vagrant-codeigniter-access_log

###### SETUP RESULT FILE############

RESULT_FOLDER=/vagrant
RESULT_LOG=$RESULT_FOLDER/result.txt

###### SETUP ACCESS LOG DATE FILE############

ACCESS_LOG_DATE=/vagrant
ACCESS_LOG_DATE=$ACCESS_LOG_DATE/log_date.txt

###### Input date from command line ##########
#Check input null 
string="$1"
if [ $# -eq 0 ]
then
    echo "Syntax: $(basename $0) string"
    exit 1
fi

#Check input length
length=$(echo ${#string})
if [ $length != 8 ]
then 
    echo "Syntax: $(basename $0) length false"
    exit 1
fi

#Check input number
echo $1 | grep "^[0-9][0-9]*$"
if [ $? != "0" ]
then
    echo "Syntax: $(basename $0) not a number"
    exit 1
fi

#Convert YYYYddmm to dd  mm YYYY
str=$1
year=${str:0:4}
prefix_month=${str:4:1}
if [ $prefix_month -eq 0 ]
then
    month=${str:5:1}
else
    month=${str:4:2}
fi
day=${str:6:2}
#Set month names
months=(Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec)
month_name="${months[$month-1]}"
date=($day"/"$month_name"/"$year)

#Save the record into new file by $date
grep $date $ACCESS_LOG > $ACCESS_LOG_DATE

####### Count number of occurrences access system #########

result=`awk -F\" '{print $2,1}' $ACCESS_LOG_DATE | awk '{a[$2]++;b[$2]=b[$s2]+$s4}END{for(i in a) print i,a[i]}'| sort -nr -k2`
echo "$result" > $RESULT_LOG   

######## Delete keyword : phpmyadmin or favico.ico ###########

perl -pi -e 'undef $_ if /phpmyadmin/' $RESULT_LOG
perl -pi -e 'undef $_ if /favicon.ico/' $RESULT_LOG
perl -pi -e 'undef $_ if s/$*.jpg//g' $RESULT_LOG
perl -pi -e 'undef $_ if s/$*.css//g' $RESULT_LOG
perl -pi -e 'undef $_ if s/$*.js//g' $RESULT_LOG

######### Print result on screen ##########################
cat $RESULT_LOG | while read LINE
do
        echo "$LINE"
done

########## End of Program ##################################
