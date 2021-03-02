# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/) (or at least it tries to).

## [0.8.0] - 2021-03-02
### Added
- Migrations are now exposed to be loaded or published

## [0.7.0] - 2021-03-02
### Added
- Content column `array` cast to `JournalEntry`
- `journal_entries` migration
- Users factory
- Users migration
### Changed
- Default model to `null` if N/A in `JournalEntryHelper::createJournalEntry`
- Don't extend base model in `JournalEntry` model
- Journal entry `content` column is now JSONb
- Rename `target_table` of `journal_entries` to `target_type` to match Laravel convention
### Removed
- `json_encode` of `content` from `JournalEntryHelper` (now dealt by cast on model)

## [0.6.0] - 2021-03-02
### Removed
- Registration of validator and journal entry helper in service provider

## [0.5.0] - 2021-03-02
## Added
- Ability to set date filter columns at runtime for repository

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
