## Model

### first

```php
Example::first();
// SELECT * FROM examples LIMIT 1
```

### find

```php
Example::find(1);
// SELECT * FROM examples WHERE id = 1 LIMIT 1
```

### get

```php
Example::query()->where('id', 1)->get();
// SELECT * FROM examples WHERE id = ?
```

### `toArray' или 'toJson'

```php
Example::query()->where('id', 1)->get()->toArray();
Example::query()->where('id', 1)->get()->toJson();
// SELECT * FROM examples WHERE id = ?

Example::query()->limit(1)->select()->toArray();
Example::query()->limit(1)->select()->toJson();
// SELECT * FROM examples LIMIT 1
```

### insert

```php
Example::query()->insert(['title' => 'Test', 'status' => 1, 'secret' => '123']);
// INSERT INTO examples(title, status, secret) VALUES('Test', 1, '123')
```

### update

```php
Example::query()->where('id', '1', '=')->update(['title' => 'Test']);
// UPDATE examples SET title = 'Test' WHERE id = 1
```

### delete

```php
Example::query()->where('id', '1', '=')->delete();
// DELETE FROM examples WHERE id = 1
```

### order

```php
Example::query()->order('id', 'DESC')->select();
// SELECT * FROM examples ORDER BY id DESC
```

### limit

```php
Example::query()->limit(1)->get();
// SELECT * FROM examples LIMIT 1
```

### group

```php
Example::query()->group(['status', 'id' => 'status = 1'])->get();
// SELECT * FROM examples GROUP BY status, id HAVING status = 1
```

### join

```php
Example::query()->join('example_two')->on('example_two.parent_id', 'examples.id', '=')->get();
// SELECT * FROM examples INNER JOIN example_two on example_two.parent_id = examples.id
```

### left join

```php
Example::query()->leftJoin('example_two')->on('example_two.parent_id', 'examples.id', '=')->get();
// SELECT * FROM examples LEFT JOIN example_two on example_two.parent_id = examples.id
```

### right join

```php
Example::query()->rightJoin('example_two')->on('example_two.parent_id', 'examples.id', '=')->get();
// SELECT * FROM examples RIGHT JOIN example_two on example_two.parent_id = examples.id
```

### where (=)

```php
Example::query()->where('id', 1)->where('status', 0)->select();
// SELECT * FROM examples WHERE id = ? AND status = 0
```

### where (>=)

```php
Example::query()->where('id', 2, '>=')->select();
// SELECT * FROM examples WHERE id >= ?
```

### whereLike

```php
Example::query()->whereLike('title' ,'Test')->where('status', '0')->select();
// SELECT * FROM examples WHERE title LIKE ? AND status = 0
``` 

### whereIn

```php
Example::query()->whereIn('id' , [1,2,3])->limit(2)->select();
// SELECT * FROM examples WHERE id IN (?, ?, ?) LIMIT 2
```

### count

```php
Example::query()->count();
// SELECT COUNT(*) AS AGGREGATE FROM examples
``` 

### Получить данные определенного столбца

```php
Example::query()->where('id' , 2, '=')->column('title');
// SELECT title FROM examples WHERE id = 2
```