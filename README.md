# snusbase_api
Code examples for the snusbase.com API. Contributions will be rewarded with free time depending on complexity of script.

## API Documentation
https://snusbase.com/documentation#api


### Optional parameters are:
`"wildcard": true/false` - example@% (% = infinite character wildcard) example@hotmail.___ (_ = wildcard only one character)

`"limit": 25` - limit how many results are shown

`"offset": 25` - if you want to do pagination. If limit = 25, you can set this to 25 to get 25 new results


## Curl
`curl -H "Content-Type: application/json" -H "Authorization: YourAuthToken" -X POST -d '{"type":"email","term":"test@example.com"}' https://yourapi.example.com`


## api_curl.php
Wildcard and limit are optional, leave blank if you're not using them. Alternatively wildcard can be toggled with false/true and limit can be set to any number you want
