# ManageBac API PHP Client Library
Documentation https://dev.faria.co/mb/

## Installation
Requires PHP 5.6.

Using Composer:

```json
{
    "require": {
      "eduvo/php-api-library": "1.*"
    }
}
```
or 
```bash
composer require eduvo/php-api-library
```
## Usage
After installing with composer, make sure to include the following line at the top of your php file.
```php
require 'vendor/autoload.php';
```
### Client
Before using the API library, you need to create a new Client using your API Token.
```php
$client = new \Eduvo\Client('YOUR API TOKEN');
```
### Examples
Here are some examples of how to use the various endpoints in the library.
#### IB Groups
Fetch all IB Groups and display the group names
```php
$ib_groups = $client->ib_groups->all();
foreach ($ib_groups as $ib_group) {
    echo $ib_group->name . PHP_EOL;
}
```
Fetch and display advisors for an IB Group
```php
$advisors = $client->ib_groups->advisors(YOUR_IB_GROUP_ID);
foreach ($advisors as $advisor) {
    $teacher = $client->teachers->get($advisor->id);
    echo $teacher->first_name . ' ' . $teacher->last_name . PHP_EOL;
}
```
Fetch and display students for an IB Group
```php
$student_ids = $client->ib_groups->students(YOUR_IB_GROUP_ID);
foreach ($student_ids as $student_id) {
    $student = $client->students->get($student_id);
    echo $student->first_name . ' ' . $student->last_name . PHP_EOL;
}
```
Add students to an IB Group
```php
$students = [STUDENT1_ID, STUDENT2_ID];
$response = $client->ib_groups->add_students(YOUR_IB_GROUP_ID, $students);
echo $response->status;
```
Remove students from an IB Group
```php
$students = [STUDENT1_ID, STUDENT2_ID];
$response = $client->ib_groups->remove_students(YOUR_IB_GROUP_ID, $students);
echo $response->status;
```
#### Classes Groups
Fetch all Classes and display the group names
```php
$classes = $client->classes->all();
foreach ($classes as $class) {
    echo $class->name . PHP_EOL;
}
```
Fetch and display the name of a single class.
```php
$class = $client->classes->get(10508262);
echo $class->name;
```
Fetch and display students for a class.
```php
$student_ids = $client->classes->students(10753516);
foreach ($student_ids as $student_id) {
    $student = $client->students->get($student_id);
    echo $student->first_name . ' ' . $student->last_name . PHP_EOL;
}
```
Add students to a class.
```php
$student_ids = [STUDENT1_ID, STUDENT2_ID];
$response = $client->classes->add_students(YOUR_CLASS_ID, $student_ids);
echo $response->status;
```
Remove students from a class.
```php
$student_ids = [STUDENT1_ID, STUDENT2_ID];
$response = $client->classes->remove_students(YOUR_CLASS_ID, $student_ids);
echo $response->status;
```
#### Parents Group
Fetch and display the email addresses of all parents.
```php
$parents = $client->parents->all();
foreach ($parents as $parent) {
    echo $parent->email . PHP_EOL;
}
```
Fetch and display the email address for a single parent.
```php
$parent = $client->parents->get(PARENT_ID);
echo $parent->email;
```
Create a new parent record.
```php
$parent = [
    'email' => 's.banderad@eduvo.com',
    'first_name' => 'Stepan',
    'last_name' => 'Bander',
    'child_ids' => [STUDENT1_ID]
];
$client->parents->create($parent);
```
Update a parent record.
```php
$parent = [
    'child_ids' => [STUDENT1_ID, STUDENT2_ID]
];
$client->parents->update(PARENT_ID, $parent);
```
Archive a parent.
```php
$response = $client->parents->archive(PARENT_ID);
echo $response->status;
```
Unarchive a parent.
```php
$response = $client->parents->unarchive(PARENT_ID);
echo $response->status;
```
#### Students Group
Fetch and display the email addresses of all students.
```php
$students = $client->students->all();
foreach ($students as $student) {
    echo $student->email . PHP_EOL;
}
```
Fetch and display the email address for a single student.
```php
$student = $client->students->get(STUDENT_ID);
echo $student->email;
```
Create a new student record.
```php
$student = [
    'email' => 'kevin.epelbaum@eduvo.com',
    'first_name' => 'Kevin',
    'last_name' => 'Epelbaum'
];
$client->students->create($student);
```
Update a student record.
```php
$student = [
    'nationalities' => ['GB', 'US']
];
$client->students->update(STUDENT_ID, $student);
```
Archive a student.
```php
$response = $client->students->archive(STUDENT_ID);
echo $response->status;
```
Unarchive a student.
```php
$response = $client->students->unarchive(STUDENT_ID);
echo $response->status;
```
#### Teachers Group
Fetch and display the email addresses of all teachers.
```php
$teachers = $client->teachers->all();
foreach ($teachers as $teacher) {
    echo $teacher->email . PHP_EOL;
}
```
Fetch and display the email address for a single student.
```php
$teacher = $client->teachers->get(TEACHER_ID);
echo $teacher->email;
```
Create a new teacher record.
```php
$teacher = [
    'email' => 'john.epelbaum@eduvo.com',
    'first_name' => 'John',
    'last_name' => 'Epelbaum'
];
$client->teachers->create($teacher);
```
Update a teacher record.
```php
$teacher = [
    'nationalities' => ['GB']
];
$client->teachers->update(TEACHER_ID, $teacher);
```
