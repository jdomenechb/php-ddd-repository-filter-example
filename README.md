# DDD Repository Filter example

The purpose of this project is to illustrate how to create a way to filter items in a repository directly in the Domain 
Driven Design Infrastructure layer, defining the rules to filter for in higher layers. 

This avoids the following common problems with repositories in a typical DDD application:
- Having too many `findBy...` methods in the repository.
- Creating one specific method for each read need: the conditions can be combined as if they were `WHERE` conditions.
- Attaching the specific needs to the Domain layer: the Architecture layer can orchestrate the items based in the input 
it receives. The input will also follow Domain-correctness, as the filters uses Domain objects.

## Why I don't use the Specification pattern?

The [Specification pattern](https://designpatternsphp.readthedocs.io/en/latest/Behavioral/Specification/README.html) 
tries to solve the same problem, but as it is defined, it has the following issues that conflict with the goal I try to 
achieve:
- It is focused on working with objects already loaded in memory, and not with infrastructure.
- Despite having an incredible flexibility for combining conditions, each condition has to be implemented in a separate 
class. This is not a problem by itself, but it becomes one when trying to translate each condition to infrastructure 
needs.

## Running the project

The project contains a demonstration using a MySQL database. First, you will need to setup the demo infrastructure. 
For this purpose, you can run the following command, which setups a database populated with a fixture of demo data using 
[Docker](https://www.docker.com/):

```
docker-compose up -d
```

Next, download the vendor libraries using:

```
composer i --no-dev
```

After that, you can already execute the demo and have a look at the code!

```
bin/run app:demo:mysql
```