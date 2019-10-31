## Snusbase API
Code examples for the snusbase.com API. Contributions will be rewarded with free time. If you need help simply contact us through one of the many support avenues available on our website.

Documentation: https://snusbase.com/documentation

### H8mail (Python)
"Email OSINT and password breach hunting. Use h8mail to find passwords through different breach and reconnaissance services[...]"
https://github.com/khast3x/h8mail

### Pure_Javascript.html (JS)
A fully functional frontend example of how to use the Snusbase.com API and all associated features in pure javascript. Leave wildcard unchecked and limit/offset empty if you're not planning on using them. To use as-is in nodejs, simply run `npm install --save node-fetch`.

### Api_Curl.php (PHP)
Example of how to use the Snusbase.com API in PHP. If you don't plan to use the optional features, simply set wildcard, limit and offset to "", null or false.

### Curl
`curl -H "Content-Type: application/json" -H "Authorization: YourAuthToken" -X POST -d '{"type":"email","term":"test@test.com"}' http://api.snusbase.com/v2/search`
