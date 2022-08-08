# JotformMentorProject
This is a project I developed for my mentor at Jotform

## Quick Usage 
1.  GET "/api/{student | grade | course}/read.php" --> Shows all record
2.  GET  "/api/{student | grade | course}/read_one.php?id=1" --> Shows one record
3.  POST "/api/{student | grade | course}/create.php" --> Creates one record
```json
// For Student
{
  "FirstName":"Kadir",
  "LastName":"Yaren",
  "Entrance Date": "2022-08-01"
}

// For Grade

{
  "CourseID":1,
  "StudentID":2,
  "Year":3, // ("2022", "2023" etc.)
  "Semester": 2  // ("1", "2" etc.)
  "Score": 85 //("72", "86" etc.)
}

```
4. "/api/{student | grade | course}/update.php" --> Updates one record
5. "/api/{student | grade | course}/delete.php" --> Deletes one record
```json
{
  "ID":4  
}
```

## Database Model 
> A course has the following features:
* "ID" (A unique id for each entry)
* "Title" ("Software Construction", "Introduction to Datascience" etc.)

> A student has the following properties:
* "ID" (A unique id for each entry),
* "FirstName",
* "LastName",
* "Entrance Date" - when the student is registered to the school

> A grade has the following properties:
* "ID" (A unique id for each entry),
* "CourseID",
* "StudentID",
* "Year" ("2022", "2023" etc.),
* "Semester" ("1", "2" etc.),
* "Score" ("72", "86" etc.)

