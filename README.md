# thrivecart-api-demo
Clone the repository and run it locally to view and use the demo, and get started with the `index.php` file.

# ThriveCart API
All responses will always be JSON-encoded. If an `error` key exists, it will contain details of the error in question which you can use. See below for details.

See `index.php`, `oauth_example.php` and `oauth_request.php` for examples on connecting and gaining permission to access a ThriveCart user's account.

Permission is granted using OAuth 2. Our access tokens do not require refreshing. A user can revoke your platform's access from inside their ThriveCart account, so you will need to handle errors.

## Getting your client ID & client secret
The ThriveCart API is currently by invitation only. You can [contact us at support](https://support.thrivecart.com) to request access.

## Errors
If the `error` key exists, it will contain a string explaining the type of error. These authorisation errors are outlined below.

* `method.invalid` The method you requested does not exist; check your request URL and ensure it's a valid endpoint (see below for documentation)
* `method.exception` The method returned an error. A key `reason` will be included, with a string explaining the problem, which can be displayed to your users

# Resources
## Products
Endpoint: `/api/external/products`  
#### GET
Returns a list of all active products
```json
[{
  "product_id":"999",
  "name":"Example Product",
  "url":"https:\/\/dfr.thrivecart.com\/example-product\/",
  "type":"standard",
  "mode":"test"
}, {
  "product_id":"111",
  "name":"Second Product",
  "url":"https:\/\/dfr.thrivecart.com\/second-product\/",
  "type":"standard",
  "mode":"live"
}]
```

## Product
Endpoint: `/api/external/products/[product_id]`  
#### GET
Return details about a specific checkout/product
```json
[{
  "product_id":"999",
  "name":"Example Product",
  "url":"https:\/\/dfr.thrivecart.com\/example-product\/",
  "type":"standard",
  "mode":"test"
}]
```