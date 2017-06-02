# Contributing to HRM

Thank you for considering contributing to HRM! :octocat: :rocket:

**Table of contents**

<!-- MarkdownTOC -->

- Code of conduct
- How can I contribute?
    - Reporting bugs
    - Suggesting Enhancements

<!-- /MarkdownTOC -->

## Code of conduct

This project and everyone participating in it is governed by the [Contributor Covenant](https://github.com/ContributorCovenant/contributor_covenant). By participating, you are expected to uphold this code. Please report unacceptable behavior to info@adevait.com.

## How can I contribute?

### Reporting bugs

Bugs are reported as [Github issues](https://github.com/adevait/hrm/issues), with the label `bug`. Before reporting a bug, please make sure it's not already [reported](https://github.com/adevait/hrm/issues?utf8=%E2%9C%93&q=is%3Aopen%20is%3Aissue%20label%3Abug%20) or [fixed](https://github.com/adevait/hrm/pulls?q=is%3Aopen+is%3Apr+label%3Abug).

We welcome pull request for bug fixes so if you think you can tackle it, feel free to. Please make sure to label it `bug`, and link it to the related issue.

Bug reports should have the following format.

**Title**

Use clear and descriptive title for the issue that identifies the problem.

**Description**

Make sure to explain the problem well and include all details you find necessary.

**Details**

1. Steps to reproduce
    * Write down as many steps as you find necessary to explain how the bug occurred and help maintainers reproduce it.
2. Expected behavior
    * What did you expect to happen?
3. Actual behavior
    * What actually happened?
4. Testing environment
    * Describe the testing environment including used browser, operating system and other details that can be helpful.

**Additional information**

This is the place for anything not included in the guide above that you find important.

> Note: If you find a Closed issue that seems like it is the same thing that you're experiencing, open a new issue and include a link to the original issue in the body of your new one.

### Suggesting Enhancements

Enhancements are also suggested in the form of [issues](https://github.com/adevait/hrm/issues), labeled `enhancement`. Before suggesting an enhancement, please make it's not already [suggested](https://github.com/adevait/hrm/issues?q=is%3Aopen+is%3Aissue+label%3Aenhancement) or [implemented](https://github.com/adevait/hrm/pulls?q=is%3Aopen+is%3Apr+label%3Abug+label%3Aenhancement). 

Before making a pull request for your suggestion, please get a feedback from some of the maintainers to see if such feature aligns with the general vision for the system. 

Pull requests for enhancements should follow these practices:

**Code Format**

1. Use [PSR-2](http://www.php-fig.org/psr/psr-2/) coding standard
    * Make sure your code follows PSR-2 coding style guide.
    * Some editors have packages that automatically build your code in PSR-2. If you don't want to think about your code structure while coding, you can easily automate it by installing such package. An example is Sublime's [Code Formatter](https://github.com/akalongman/sublimetext-codeformatter).
2. Document your code
    * All of your code should be properly documented. A great package for generating code documentation is [DocBlockr](https://packagecontrol.io/packages/DocBlockr).

**General Structure**

1. Modules
    * The system is organized in modules located in `app/Modules`. Every module has its own HTTP part, models, repositories and resources, and they follow Laravel's nesting and conventions. 
    * When adding a new module, check one of the existing ones as example for the code structure and practices.
2. Logic
    * Controllers
        - They are following the RESTful structure and are organized as resources.
        - Controller methods should not do any complex operations or calculations. 
        - All database operations are handled in repositories (see point 3 below).
        - Any function that is used more than once should be a helper function.
    * Validation
        - Every controller has its `FormRequest` class, located in `ModuleName/Http/Requests` where the request validation is done prior to executing the code in the controller method.
        - Apart from the required rules, other validation rules should be added based on common sense.
    * Routes
        - All routes should be defined as resources and be properly nested (see existing routes as example).
        - All routes should be named and used accordingly throughout the code.
3. Database
    * Migrations
    All database alterations should be done using migrations. 
        - Migrations used for creating a table in the database should follow this naming convention: `create_[table_name]_table`.
        - Migrations used for altering a table in the database should follow this naming convention: `update_[table_name]_[altering_description]`.
        - Every table should have timestamps and soft deletes.
        - Every table should have an auto increment primary key.
        - Every foreign key should be defined and cascade on delete and update.
    * Models
        - Tables representing many to many relations should not have separate model class.
        - Every model should have the table name defined as a protected attribute.
        - Every model should have the guarded attributes specified.
    * Repositories
        - All complex database operations should be handled in a repository rather than the model itself.
        - Every model has its own repository that extends `App\Repositories\EloquentRepository`.
        - Every repository should have its interface and binded through it to allow for higher abstraction. The repository bindings are done in `App\Providers\RepositoryServiceProvider`.
        - Don't use model attributes or constants directly in external classes (e.g. `User::ACTIVE`). Instead, do it through the respective repository, like so: `$userRepository->model::ACTIVE`. To be able to use that, you should set the repository's `allowedAttributes` attribute to include the model - `$allowedAttributes = ['model']`.
4. Other
    * Breadcrumbs
        - Every page should have its breadcrumbs defined in `routes/breadcrumbs`. 
    * Localization
        - Every text used throughout the system should be defined in `/resources/lang/en/app.php`, to make it easier for implementing localization eventually.
        - Make sure to follow the existing nesting structure and naming for all texts added in the lang file.