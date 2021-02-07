## Snusbase API v3

Below you'll find documentation for all the private API endpoints. You can also use pre-written tools such as:

* [h8mail](https://github.com/khast3x/h8mail) - Email OSINT & Password breach hunting tool, locally or using premium services
* [pure_javascript.html](/pure_javascript.html) - A purely javascript example of how to interact with the Snusbase API and all its features
* [api_curl.php](api_curl.php) - A PHP function that utilizes php-curl to interact with the Snusbase API and all its features


### Fields

You can currently search 6 fields ("**username**", "**email**", "**lastip**", "**hash**", "**password**" and "**name**").

By default we will display 8 fields ("**username**", "**email**", "**lastip**", "**hash**", "**salt**", "**password**", "**name**" and "**db**").

* If you used API v2/v1 and you had logic for removing "", " ", and NULL fields, those are now parsed out on the backend.


### Errors

On the /v3/search endpoint we always respond with a "error" and a "reason" field. If they're down to bad queries they should be descriptive, if it's down to internal errors or maintenance it will look similar to the below and generally resolve itself within 10 seconds of the error first appearing.
```
{
  "error": "failed_on_search",
  "reason": "Search failed while waiting for backend"
}
```

### Basic Search

#### Request
```
curl -H "content-type: application/json" -H "authorization: API_KEY" -X POST -d '{"type":"email","term":"test@test.com"}' https://api.snusbase.com/v3/search
```
#### Query
```
{
  "type":"email",
  "term":"test@test.com"
}
```
#### Response
```
{
  "results": [
    {"email":"Test@test.com","username":"Fmuser800","hash":"5a105e8b9d40e1329780d62ea2265d8a","db":"LAST_FM_41M_MUSIC_2012"},
    {"email":"test@test.com","password":"test123","db":"IMGUR_COM_2M_SOCIAL_092013"}
  ],
  "took":0.105,
  "size":2588
}
```

### Wildcard Search

Here we use the "%" character to specify that anything starting with "test@" should be included in the first round of parsing. Second round checks for a . followed by 3 characters, represented by the three "_".

#### Request
```
curl -H "content-type: application/json" -H "authorization: API_KEY" -X POST -d '{"type":"email","term":"test@%.___","wildcard":true}' https://api.snusbase.com/v3/search
```
#### Query
```
{
  "type":"email",
  "term":"test@%.___",
  "wildcard":true
}
```
#### Response
```
{
  "results": [
    {"email":"test@glofox.com","username":"test@glofox.com","hash":"7f2ababa423061c509f4923dd04b6cf1","name":"Glofox Test","db":"GLOFOX_COM_2M_FITNESS_032020"},
    {"email":"test@testian123.com","username":"testian123","password":"123456","lastip":"70.81.142.30","hash":"a49dce509af07a3d003798ce5b800647","db":"FLING_COM_39M_DATING_2011"}
  ],
  "took":0.79,
  "size":54577
}
```
* You can escape both the wildcard characters by prefixing them with a backslash ("\%", "\_").

### Limit/Offset Search

Since the last one had 54,577 results, you might want to paginate it. You can do this by adding the limit and offset options.

#### Request
```
curl -H "content-type: application/json" -H "authorization: API_KEY" -X POST -d '{"type":"email","term":"test@%.___","wildcard":true,"limit":5,"offset":0}' https://api.snusbase.com/v3/search
```
#### Query
```
{
  "type":"email",
  "term":"test@%.___",
  "wildcard":true,
  "limit":5,
  "offset":0
}
```
#### Response
```
{
  "results": [
    {"email":"test@gmail.com","password":"newstandard","db":"IMGUR_COM_2M_SOCIAL_092013"},
    {"email":"test@fannrem.com","password":"warrior","db":"IMGUR_COM_2M_SOCIAL_092013"},
    {"email":"test@digitalruby.com","password":"test!2345","db":"IMGUR_COM_2M_SOCIAL_092013"},
    {"email":"test@comcast.net","password":"helloo","db":"IMGUR_COM_2M_SOCIAL_092013"},
    {"email":"test@aol.com","password":"test101test","db":"IMGUR_COM_2M_SOCIAL_092013"}
  ],
  "took":0.642,
  "size":5
}
```
* Keep in mind this doesn't give you the full result count and does (almost) nothing to improve search performance, so we generally recommend you do this through software on your own frontend.

### Hash Lookup

For clarification, this API stores hashes that have been previously cracked. It doesn't actually attempt to crack any hashes natively and is updated once every quarter.

#### Request
```
curl -H "content-type: application/json" -H "authorization: API_KEY" -X POST -d '{"hash": "164a645acf2f0b3ac49e7139602c29d6"}' https://api.snusbase.com/v3/hash
```
#### Query
```
{
  "hash": "164a645acf2f0b3ac49e7139602c29d6"
}
```
#### Response
```
{
  "found":true,
  "term":"164a645acf2f0b3ac49e7139602c29d6",
  "password":"Password132"
}
```

### IP Whois API

#### Request
```
curl -H "content-type: application/json" -H "authorization: API_KEY" -X POST -d '{"address": "12.34.56.78"}' https://api.snusbase.com/v3/ipwhois
```
#### Query
```
{
  "address": "12.34.56.78"
}
```
#### Response
```
{
  "status":"success",
  "country":"United States",
  "countryCode":"US",
  "region":"WV",
  "regionName":"West Virginia",
  "city":"Huntington",
  "zip":"25701",
  "timezone":"America/New_York",
  "isp":"AT&T Services",
  "org":"Northwestern Mutualvb2e-is OR",
  "as":"AS7018 AT&T Services, Inc.",
  "mobile":false,
  "proxy":false
}
```
* If you pass a domain name as the "address" field, it will resolve it to an IP address and function the same way.
