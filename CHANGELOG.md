# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/) (or at least it tries to).

## [0.4.0] - 2021-02-20
### Added
- Default attributes to test model repository
- `getModelName` method to base repository
- base `Factory`
### Changed
- Made base Repository abstract

## [0.3.0] - 2021-02-20
### Changed
- Pin PHP v8 in composer.json and CI and dependencies updates
- Refactor base validator usage
## Fixed
- Custom validator resolver
- Psalm stan fixes

## [0.2.0] - 2021-02-07
### Added
- Basic auth layer
- Config variables: bulk insert chunk size, pagination, and journal mode
- HTTP form requests implementation and contracts
- Validator
- Validation rules
- User model
### Changed
- Controllers restructure
- Policy to always return false
- Repository concerns layer improvements
- Repository layer improvements
- Service layer improvements

## [0.1.0] - 2021-01-16
### Added
- First release
