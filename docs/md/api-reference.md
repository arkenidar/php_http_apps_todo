# API / Route Reference

All routes are accessed via the `?r=<route>` query parameter on the router (`www/router.php`). The `$_REQUEST` superglobal (covering both GET and POST) is passed to each handler as `$request_variables`.

---

## Todo Routes

### `todo_list`

Renders the HTML todo list page for the authenticated user.

| Attribute      | Value    |
| -------------- | -------- |
| **Auth**       | Required |
| **Method**     | GET      |
| **Response**   | HTML     |
| **Parameters** | None     |

**Example:** `?r=todo_list`

---

### `todo_list_json_get`

Returns the user's todo items as a JSON array.

| Attribute      | Value              |
| -------------- | ------------------ |
| **Auth**       | Required           |
| **Method**     | GET                |
| **Response**   | `application/json` |
| **Parameters** | None               |

**Example:** `?r=todo_list_json_get`

**Response shape:**

```json
[
  {
    "id": 1,
    "description": "Buy groceries",
    "state": 0,
    "user_id": 1
  }
]
```

---

### `todo_add`

Adds a new todo item for the authenticated user.

| Attribute      | Value                             |
| -------------- | --------------------------------- |
| **Auth**       | Required                          |
| **Method**     | POST                              |
| **Response**   | Redirect to `todo_list`           |
| **Parameters** | `item` (string) — the description |

**Example POST:** `?r=todo_add` with body `item=Buy+groceries`

> Empty or whitespace-only descriptions are silently ignored.

---

### `todo_remove`

Deletes a todo item belonging to the authenticated user.

| Attribute      | Value                    |
| -------------- | ------------------------ |
| **Auth**       | Required                 |
| **Method**     | GET/POST                 |
| **Response**   | Redirect to `todo_list`  |
| **Parameters** | `id` (int) — the todo ID |

**Example:** `?r=todo_remove&id=1`

> If the todo does not belong to the authenticated user, the request is silently ignored (no error shown).

---

### `todo_detail`

Renders the detail/edit view for a single todo item.

| Attribute      | Value                    |
| -------------- | ------------------------ |
| **Auth**       | Required                 |
| **Method**     | GET                      |
| **Response**   | HTML                     |
| **Parameters** | `id` (int) — the todo ID |

**Example:** `?r=todo_detail&id=1`

> If the todo does not belong to the authenticated user, the request is silently ignored.

---

### `todo_update_description`

Updates the description of a todo item.

| Attribute      | Value                              |
| -------------- | ---------------------------------- |
| **Auth**       | Required                           |
| **Method**     | POST                               |
| **Response**   | Redirect to `todo_list`            |
| **Parameters** | `id` (int), `description` (string) |

**Example POST:** `?r=todo_update_description` with body `id=1&description=Updated+task`

> If the description is empty or whitespace-only, the todo is **deleted** instead of updated.  
> If the todo does not belong to the authenticated user, the request is silently ignored.

---

### `todo_update_state`

Toggles the checked/done state of a todo item.

| Attribute      | Value                                                     |
| -------------- | --------------------------------------------------------- |
| **Auth**       | Required                                                  |
| **Method**     | POST                                                      |
| **Response**   | Redirect to `todo_list`                                   |
| **Parameters** | `id` (int), `state` (int: `0` = unchecked, `1` = checked) |

**Example POST:** `?r=todo_update_state` with body `id=1&state=1`

> In the UI, this is called via `fetch()` (AJAX) so the page does not reload.  
> If the todo does not belong to the authenticated user, the request is silently ignored.

---

## User Routes

### `user_create_form`

Renders the user registration form.

| Attribute      | Value         |
| -------------- | ------------- |
| **Auth**       | None (public) |
| **Method**     | GET           |
| **Response**   | HTML          |
| **Parameters** | None          |

**Example:** `?r=user_create_form`

---

### `user_create_submit`

Processes user registration.

| Attribute      | Value                                                                 |
| -------------- | --------------------------------------------------------------------- |
| **Auth**       | None (public)                                                         |
| **Method**     | POST                                                                  |
| **Response**   | HTML (re-renders form with success/error)                             |
| **Parameters** | `username` (string), `password` (string), `confirm_password` (string) |

**Example POST:** `?r=user_create_submit` with body `username=jdoe&password=secret&confirm_password=secret`

**Possible responses:**

- `"Passwords do not match!"` — `password` ≠ `confirm_password`
- `"User already exists!"` — username is taken
- `"User created successfully!"` — account created

> Passwords are hashed with `password_hash()` using `PASSWORD_DEFAULT` (bcrypt).

---

### `user_login_form`

Renders the login form.

| Attribute      | Value                                                   |
| -------------- | ------------------------------------------------------- |
| **Auth**       | None (public)                                           |
| **Method**     | GET                                                     |
| **Response**   | HTML                                                    |
| **Parameters** | Optional: `error=invalid_credentials` displays an error |

**Example:** `?r=user_login_form`

---

### `user_login_submit`

Processes login.

| Attribute      | Value                                                                                      |
| -------------- | ------------------------------------------------------------------------------------------ |
| **Auth**       | None (public)                                                                              |
| **Method**     | POST                                                                                       |
| **Response**   | Redirect to `todo_list` (success) or `user_login_form?error=invalid_credentials` (failure) |
| **Parameters** | `username` (string), `password` (string)                                                   |

**Example POST:** `?r=user_login_submit` with body `username=jdoe&password=secret`

> On success, `$_SESSION['user']` and `$_SESSION['user_id']` are set.

---

### `user_logout`

Destroys the session and redirects to the login form.

| Attribute      | Value                            |
| -------------- | -------------------------------- |
| **Auth**       | None (destroys existing session) |
| **Method**     | GET/POST                         |
| **Response**   | Redirect to `user_login_form`    |
| **Parameters** | None                             |

**Example:** `?r=user_logout`

---

## Default Route

### `''` (empty / home)

Redirects to `todo_list`.

| Attribute    | Value                                    |
| ------------ | ---------------------------------------- |
| **Auth**     | Required (redirects through `todo_list`) |
| **Method**   | GET                                      |
| **Response** | Redirect to `todo_list`                  |

**Example:** `?r=`
