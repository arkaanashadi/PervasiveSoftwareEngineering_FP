import json
import smtplib

def send_mail(subject, body):
	with open("email-data.json") as jsonData:
		emailData = json.load(jsonData)
	smtpUser = emailData["sender"]
	smtpPass = emailData["sender-pass"]
	jsonData.close()

	toAdd = emailData["reciever"]
	fromAdd = smtpUser

	header = "To: "+ toAdd + '\n' + "From: " + fromAdd + '\n' + "Subject: " + subject

	print(header + '\n' + body)

	# s = smtplib.SMTP("smtp.gmail.com", 587)

	# s.ehlo()
	# s.starttls()
	# s.ehlo()

	# s.login(smtpUser, smtpPass)
	# s.sendmail(fromAdd, toAdd, header + "\n\n" + body)

	jsonData.close()
	# s.quit()