# API Test Guidelines

## Authentication Endpoints

### User Registration

**Endpoint:** `POST /api/register`

**Description:** Register a new user.

**Request:**
```json
{
  "name": "Zenas",
  "email": "zenas@gmail.com",
  "password": "123456"
}
```

**Response:**
```json
{
    "name": "Zenas",
    "email": "zenas1@gmail.com",
    "updated_at": "2023-11-15T11:48:30.000000Z",
    "created_at": "2023-11-15T11:48:30.000000Z",
    "id": 2
}
```

### User Login

**Endpoint:** `POST /api/login`

**Description:** Authenticate a user.

**Request:**
```json
{
  "email": "zenas@gmail.com",
  "password": "123456"
}
```

**Response:**
```json
{
    "token": "3|jXOWgeWbixIIDPOEWp5m5i7HpShSHPC0AvPTGHlta9e0a2bd"
}
```

## Create Item

**Requires Auth**

**Endpoint:** `POST /api/v1/items

**Description:** Create a new item.

**Request:**
```json
{
  "description": "Book",
  "unit_price": 22.22,
  "quantity": 2
}
```

**Response:**
```json
{
    "data": {
        "id": 11,
        "description": "Book",
        "unit_price": 22.22,
        "quantity": 2,
        "amount": 44.44,
        "created_at": "2023-11-15T11:50:04.000000Z",
        "updated_at": "2023-11-15T11:50:04.000000Z"
    }
}
```

## Get Items
**Requires Auth**

**Endpoint:** `GET /api/v1/items`

**Description:** Retrieve a list of items.

**Response:**
- Status Code: 200 (OK)
- List of items in the response.
```json
{
  "data": [
    {
      "id": 2,
      "description": "soluta",
      "unit_price": 9.1,
      "quantity": 67,
      "amount": 609.7,
      "created_at": "2023-11-15T10:34:41.000000Z",
      "updated_at": "2023-11-15T10:34:41.000000Z"
    },
    {
      "id": 3,
      "description": "et",
      "unit_price": 6.2,
      "quantity": 64,
      "amount": 396.8,
      "created_at": "2023-11-15T10:34:41.000000Z",
      "updated_at": "2023-11-15T10:34:41.000000Z"
    },
    // ... (other items)
  ]
}
```

## Create Customer
**Requires Auth**

**Endpoint:** `POST /api/v1/customers`

**Description:** Create a new customer.

**Request:**
```json
{
  "name": "Zenas",
  "email": "1234@gmail.com",
  "phone_number": "233559616904"
}
```
**Response:**
* Status Code: 201 (Created)
* The created customer details in the response.
```json
{
  "data": {
    "id": 7,
    "name": "Zenas",
    "email": "12345@gmail.com",
    "phone_number": "233559616904",
    "created_at": "2023-11-15T11:50:32.000000Z",
    "updated_at": "2023-11-15T11:50:32.000000Z"
  }
}
```

## Create Invoice
**Requires Auth**

**Endpoint:** `POST /api/v1/invoices`

**Description:** Create a new invoice.

**Request:**
```json
{
  "customer_id": 1,
  "due_date": "12/12/2023",
  "items": [
    {
      "item_id": 2,
      "quantity": 1
    }
  ]
}
```

**Response:**
```json
{
    "data": {
        "id": 3,
        "amount": 9.1,
        "issue_date": "2023-11-15 11:50:55",
        "due_date": "12/12/2023",
        "customer": {
            "id": 1,
            "name": "Hettie Aufderhar",
            "email": "tristian53@hotmail.com",
            "phone_number": "330-281-1328",
            "created_at": "2023-11-15T10:34:41.000000Z",
            "updated_at": "2023-11-15T10:34:41.000000Z"
        },
        "items": [
            {
                "id": 5,
                "invoice_id": 3,
                "item_id": 2,
                "quantity": 1,
                "amount": "9.10",
                "created_at": "2023-11-15T11:50:55.000000Z",
                "updated_at": "2023-11-15T11:50:55.000000Z"
            }
        ],
        "created_at": "2023-11-15T11:50:55.000000Z",
        "updated_at": "2023-11-15T11:50:55.000000Z"
    }
}
```

## Get Invoices
**Requires Auth**

**Endpoint:** `GET /api/v1/invoices`

**Description:** Retrieve a list of invoices.

**Response:**
- Status Code: 200 (OK)
- List of invoices in the response.
```json
{
  "data": [
    {
      "id": 1,
      "amount": "8.20",
      "issue_date": "2023-11-15 10:35:43",
      "due_date": "2023-12-12 00:00:00",
      "customer": {
        "id": 6,
        "name": "Zenas",
        "email": "1234@gmail.com",
        "phone_number": "233559616904",
        "created_at": "2023-11-15T10:35:33.000000Z",
        "updated_at": "2023-11-15T10:35:33.000000Z"
      },
      "items": [
        {
          "id": 1,
          "invoice_id": 1,
          "item_id": 1,
          "quantity": 1,
          "amount": "5.50",
          "created_at": "2023-11-15T10:35:43.000000Z",
          "updated_at": "2023-11-15T10:35:43.000000Z"
        },
        {
          "id": 2,
          "invoice_id": 1,
          "item_id": 10,
          "quantity": 1,
          "amount": "2.70",
          "created_at": "2023-11-15T10:35:43.000000Z",
          "updated_at": "2023-11-15T10:35:43.000000Z"
        }
      ],
      "created_at": "2023-11-15T10:35:43.000000Z",
      "updated_at": "2023-11-15T10:35:43.000000Z"
    },
    {
      "id": 2,
      "amount": "8.20",
      "issue_date": "2023-11-15 11:04:44",
      "due_date": "2023-12-12 00:00:00",
      "customer": {
        "id": 1,
        "name": "Hettie Aufderhar",
        "email": "tristian53@hotmail.com",
        "phone_number": "330-281-1328",
        "created_at": "2023-11-15T10:34:41.000000Z",
        "updated_at": "2023-11-15T10:34:41.000000Z"
      },
      "items": [
        {
          "id": 3,
          "invoice_id": 2,
          "item_id": 1,
          "quantity": 1,
          "amount": "5.50",
          "created_at": "2023-11-15T11:04:44.000000Z",
          "updated_at": "2023-11-15T11:04:44.000000Z"
        },
        {
          "id": 4,
          "invoice_id": 2,
          "item_id": 10,
          "quantity": 1,
          "amount": "2.70",
          "created_at": "2023-11-15T11:04:44.000000Z",
          "updated_at": "2023-11-15T11:04:44.000000Z"
        }
      ],
      "created_at": "2023-11-15T11:04:44.000000Z",
      "updated_at": "2023-11-15T11:04:44.000000Z"
    },
    {
      "id": 3,
      "amount": "9.10",
      "issue_date": "2023-11-15 11:50:55",
      "due_date": "2023-12-12 00:00:00",
      "customer": {
        "id": 1,
        "name": "Hettie Aufderhar",
        "email": "tristian53@hotmail.com",
        "phone_number": "330-281-1328",
        "created_at": "2023-11-15T10:34:41.000000Z",
        "updated_at": "2023-11-15T10:34:41.000000Z"
      },
      "items": [
        {
          "id": 5,
          "invoice_id": 3,
          "item_id": 2,
          "quantity": 1,
          "amount": "9.10",
          "created_at": "2023-11-15T11:50:55.000000Z",
          "updated_at": "2023-11-15T11:50:55.000000Z"
        }
      ],
      "created_at": "2023-11-15T11:50:55.000000Z",
      "updated_at": "2023-11-15T11:50:55.000000Z"
    },
    {
      "id": 4,
      "amount": "9.10",
      "issue_date": "2023-11-15 11:52:09",
      "due_date": "2023-12-12 00:00:00",
      "customer": {
        "id": 1,
        "name": "Hettie Aufderhar",
        "email": "tristian53@hotmail.com",
        "phone_number": "330-281-1328",
        "created_at": "2023-11-15T10:34:41.000000Z",
        "updated_at": "2023-11-15T10:34:41.000000Z"
      },
      "items": [
        {
          "id": 6,
          "invoice_id": 4,
          "item_id": 2,
          "quantity": 1,
          "amount": "9.10",
          "created_at": "2023-11-15T11:52:09.000000Z",
          "updated_at": "2023-11-15T11:52:09.000000Z"
        }
      ],
      "created_at": "2023-11-15T11:52:09.000000Z",
      "updated_at": "2023-11-15T11:52:09.000000Z"
    }
  ]
}
```
