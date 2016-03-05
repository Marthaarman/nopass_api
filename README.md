# noPass API
The nopass.org api for no more passwords
* Project page: http://www.nopass.org / https://nopass.mhwebdevelopment.nl
* Repository: https://github.com/marthaarman/nopass_api
* Version: 1.0.0

##Description
noPass is a free authentication service to provide websites an additional way of authenticating their users. 
With the noPass app, users can quickly authenticate themselves to a website without any passwords.


##Requirements
* Android or iOS device (with the nopass app installed)
* noPass account
* siteKey and secretKey (can both be obtained inside the developer area on noPass)

##Installation

###Client side
Paste this snippet before the closing </head> tag on your HTML template:

`<script src="https://nopass.mhwebdevelopment.nl/api/api.js"></script>`


Paste this snippet at the end of the <form> where you want the noPass widget to appear:

`<div class="mhwd-nopass" data-sitekey="your_site_key"></div>`

In order to submit the form directly on approval you can add the "submit-form" tag to the DIV element containing the "mhwd-nopass" class.

###Server side
After each authentication you can verify the authentication on the server side using an API request in PHP. 
When the authentication has been solved by the user, a new field will be added to the html form and can be resolved by the name "nopass-session". 

URL: https://nopass.mhwebdevelopment.nl/api/verify.php
METHOD: POST

POST Parameters| Description
------------ | -------------
secret | Required. The shared "secret" key between your site-label and noPass.
nopass-session | Required. The user session token provided by the noPass to the user and provided to your site in the "nopass-session" POST.
remoteip | Optional. the end user's IP address.

#### API response (JSON)
	{
	
		"connection_status": true|false,	//Whether the given data is correct or not
	
		"success": true|false,			//Authentication => approved (true) or rejected (false)
	
		"account": [nopass_email, email],	//The email the user has used to authenticate
	
		"errors":[...]
		
	}

###Additional
The noPass users can switch between their email addresses upon each authentication request. 
The email addresses can be added, disabled or deleted but not the nopass_email. It is recommended to authenticate using this email address to prevent any unwanted consequences. 
The nopass_email will ALWAYS be returned in the API response.
