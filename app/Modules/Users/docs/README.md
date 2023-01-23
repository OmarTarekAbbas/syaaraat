# Schools Module

Also known as `Schools` module.

## Features

-   Fully Managed By Schools (CRUD).


## Related Modules

-   [Guest](./../../Guests/docs/README.md)
-   [Users Groups](./users-groups.md)

## Requests

### Admin Requests

#### List Users

**GET** `/admin/schools`

Request Headers: [Request Headers](#request-headers)

Query Params (For Filtering)

-   `name`: Search For Schools By Name
-   `id`: Search For Schools By Id

Response Payload

-   [schools Record](#schools-record)

```json
{
    "records": "UserRecord[]",
}
```

## Create New Schools

This request allows admin to create new Schools from the admin dashboard.

**POST** `/admin/Schools`

Request Headers:

[Request Headers](#request-headers) +

-   **Content-Type**: `multipart/form-data`

Request Payload

| Key          | Type   | Required | Description               |
| ------------ | ------ | -------- | ------------------------- |
| **name**     | String | **Yes**  | schools Name             |

Response Payload

Success: `201`

-   [schools Record](#schools-record)
-   [Error Key Value](#error-key-value)

```json
{
    "record": "schoolsRecord"
}
```

Bad Request `400`

```json
{
    "errors": "ErrorKeyValue[]"
}
```

### schools Record

```json
{
    "id": "int",
    "name": "string",
}
```

### Error Key Value

```json
{
    "key": "string",
    "message": "string"
}
```
