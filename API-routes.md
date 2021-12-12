
# COMPLETED API ROUTES

[Go to deployed backend](https://nyumbanibackend.herokuapp.com/)

**Auth**

- `/register`
 >Register new user
 
 <details>
 <summary>POST body format</summary>
 
 ```json
{
 "firstName" : "Neme1",
 "lastName" : "Name2",
 "email" : "email@gmail.com",
 "role" : "Owner/Tenant/Administrator",
 "password" : "1234",
 "passwordConfirm" : "1234",
}
 ```
</details>

- `/login`
 >Login using email
 
 <details>
 <summary>POST body format</summary>
 
 ```json
{
 "email" : "email@gmail.com",
 "password" : "1234"
}
 ```
</details>

---
**Properties**

 - `/properties/?`
 >Gets properties belonging to single user
- `/addProperty`
<details>
 <summary>Request Body format</summary>
 
```json
{
        "ownerID": "2",
        "thumbnailPhoto": "test: path",
        "propertyType": "Villa",
        "propertyCounty": "Mombasa",
        "propertyPhysicalAddress": "Tempore maxime dolo",
        "propertyDescription": "Molestias culpa dolo",
        "propertyRent": "Est incidunt doloru",
        "otherImages": {
          "1": "pic1.jpg",
          "2": "pic2.jpg"
        },
        "dateBuilt": "24-12-2020",
        "videoLink": "https://youtu.be/dQw4w9WgXcQ",
        "propertySize": "15",
        "landSize": "22",
        "bedrooms": "5",
        "bathrooms": "2",
        "propertyFeatures": {
          
            "balcony":"1",
            "security":"0",
            "laundry":"0",
            "elevator":"0",
            "parking":"1"
         
        }
      }
```
  </details>
  
  - `/tenants/?`
 >Gets properties rented by a tenant

----
**Listings**

 - `/listings`
> Gets all listings
- `/listings/?`
>Gets single listing
- `listing/?`
>Gets listings belonging to specific owner

---
**Applications**

- `/applications/?`
>Gets properties belonging to single user

---
**Requests**

- `/requests/?`
>Gets all requests for a single property owner

- `tenants/submit_request`
  <details>
   <summary>Request Body format</summary>

  ```json
  {
    "propertyID" : 11,
    "requestMessage" : "Door handle is broken and needs repair"
  }
  ```
  </details>
---
**Transactions**

- `/payments/?`
>Gets payment history of a single property
<details>
 <summary>Example:  /payments/10</summary>

  ```json
  {
    "propertyID": "10",
    "ownerID": "1",
    "tenantID": "6",
    "propertyDescription": "3 Bedroom Apartment in Nairobi",
    "propertyCounty": "Nairobi",
    "propertyPhysicalAddress": "Mzima Springs, Lavington",
    "propertyType": "Apartment",
    "thumbnailPhoto": "thumbnail1.jfif",
    "rentDueDate": "1",
    "dateRented": "2019-09-12",
    "tenantFirstName": "Steve",
    "tenantLastName": "Miller",
    "tenantEmail": "smiller@gmail.com",
    "payments": [
        {
            "paymentID": "1",
            "propertyID": "10",
            "senderID": "6",
            "recipientID": "1",
            "paymentMethod": "Rent",
            "paymentDate": "2021-11-01",
            "paymentAmount": "70000",
            "status": "Paid"
        },
        {
            "paymentID": "2",
            "propertyID": "10",
            "senderID": "6",
            "recipientID": "1",
            "paymentMethod": "Rent",
            "paymentDate": "2021-10-01",
            "paymentAmount": "70000",
            "status": "Paid"
        },
        {
            "paymentID": "3",
            "propertyID": "10",
            "senderID": "6",
            "recipientID": "2",
            "paymentMethod": "Rent",
            "paymentDate": "2021-09-01",
            "paymentAmount": "70000",
            "status": "Pending"
        }
    ],
    "rentStatus": "Overdue",
    "rentArrears": -1610000
}
  ```
  </details>
  
- `/payments/summary/?`
>Gets transaction summary of single property owner

<details>
  <summary>Example: /payments/summary/1</summary>

  ```json
  {
    "totalRentPaid-AllTime": 210000,
    "totalExpectedRent": 5088000,
    "monthlyExpectedRent": 284000,
    "monthRentReturn": 70000,
    "fromDate": "2019-09-12"
}
  ```
  </details>
  
  - `/payments/transactions/?`
>Gets payment summaries of all properties belonging to owner

<details>
  <summary>Example: /payments/transactions/1</summary>

  ```json
  [
    {
        "propertyID": "15",
        "thumbnailPhoto": "placeholder.png",
        "propertyDescription": "Single Bedroom Apartment in Kiambu",
        "propertyRent": "35000",
        "rentStatus": "Overdue",
        "rentArrears": -770000
    },
    {
        "propertyID": "16",
        "thumbnailPhoto": "placeholder.png",
        "propertyDescription": "2 Bedroom Apartment in Nairobi",
        "propertyRent": "50000",
        "rentStatus": null,
        "rentArrears": null
    }
]
  ```
  </details>
  
 - `/payments/tenant/?`
>Gets payment history of a single tenant
<details>
  <summary>Example: /payments/tenant/6</summary>

  ```json
  [
 {
        "paymentID": "1",
        "propertyID": "10",
        "senderID": "6",
        "recipientID": "1",
        "paymentMethod": "Card",
        "paymentDate": "2021-11-01",
        "paymentAmount": "70000"
    },
    {
        "paymentID": "2",
        "propertyID": "10",
        "senderID": "6",
        "recipientID": "1",
        "paymentMethod": "Rent",
        "paymentDate": "2021-10-01",
        "paymentAmount": "70000"
    }
    
]
  ```
  </details>
  
- `/makePayment`
>`POST` requst that adds a payment
<details>
  <summary>Request body</summary>

  ```json

{
    "propertyID" : 10,
    "tenantID" : 6,
    "ownerID": 1,
    "paymentAmount": 20000
} 

  ```
  </details>

---
**Property Verification Requests**

- `/verifications`
>Gets all verification requests that have not been taken up by an admin

- `/verifications/?`
>Gets verification details of a specific request

- `/queue/?`
>Gets queued verification requests per Admin

 - `/enqueue`
>`POST` requests that assigns a verification requests to an admin's queue

<details>
  <summary>Requst Body</summary>

  ```json
    {
      "id": 1, //verification request ID
      "admin": 23
    }
  ```
  </details>
  
  - `/verifications/accept/?`
>Verifies a property by request id

- `/verifications/reject/?`
>Rejects/unverifies verification for property by request id


- `/verifications/accepted`
>Gets all verification requests that have been rejected

- `/verifications/rejected`
>Gets all verification requests that have been accepted
