db.students.drop();
db.students.insertMany([
    {
        "_id" : ObjectId("5f0b47acf94e805b9d84d442"),
        "id" : "a1b2c3",
        "name" : "Gumball Watterson",
        "school_class" : "first",
        "registered_in" : ISODate("2018-09-07T10:00:00.000Z")
    },
    {
        "_id" : ObjectId("5f0b4853f94e805b9d84d469"),
        "id" : "d4e5f6",
        "name" : "Finn The Human",
        "school_class" : "third",
        "registered_in" : ISODate("2018-08-01T10:00:00.000Z")
    },
    {
        "_id" : ObjectId("5f0b48adf94e805b9d84d473"),
        "id" : "g7h8i9",
        "name" : "Steven Universe",
        "school_class" : "third",
        "registered_in" : ISODate("2019-03-20T10:00:00.000Z")
    },
    {
        "_id" : ObjectId("5f0b48c6f94e805b9d84d47a"),
        "id" : "j1k2l3",
        "name" : "Phineas Flynn",
        "school_class" : "second",
        "registered_in" : ISODate("2019-04-18T10:00:00.000Z")
    },
    {
        "_id" : ObjectId("5f0b48def94e805b9d84d483"),
        "id" : "m4n5o6",
        "name" : "Ferb Fletcher",
        "school_class" : "third",
        "registered_in" : ISODate("2019-05-20T10:00:00.000Z")
    },
    {
        "_id" : ObjectId("5f0b48fdf94e805b9d84d489"),
        "id" : "p7q8r9",
        "name" : "Marinette Dupain-Cheng",
        "school_class" : "third",
        "registered_in" : ISODate("2020-01-20T10:00:00.000Z")
    },
    {
        "_id" : ObjectId("5f0b491bf94e805b9d84d48f"),
        "id" : "s1t2u3",
        "name" : "Adrien Agreste",
        "school_class" : "first",
        "registered_in" : ISODate("2020-01-20T10:00:00.000Z")
    }
]);