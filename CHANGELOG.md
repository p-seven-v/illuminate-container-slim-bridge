# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/p-seven-v/illuminate-container-slim-bridge/compare/1.1.0...master)

## [1.1.0 - 2021-03-25](https://github.com/p-seven-v/illuminate-container-slim-bridge/compare/1.0.0...1.1.0)
### Changed
- Bumped php version requirement to 7.3
- Allowed PHP 8
- Allowed illuminate/container ^8.0

## [1.0.0 - 2020-11-15](https://github.com/p-seven-v/illuminate-container-slim-bridge/compare/0.2.1...1.0.0)
### Added
- Added `instance` method to service provider, so that created object could be passed into container.

## [0.2.1 - 2020-09-12](https://github.com/p-seven-v/illuminate-container-slim-bridge/compare/0.2.0...0.2.1)
### Fixed
- Allowed Closures to be passed to bind and singleton methods

## [0.2.0 - 2020-08-30](https://github.com/p-seven-v/illuminate-container-slim-bridge/compare/0.1.0...0.2.0)
### Added
- Added possibility to configure the container using service providers.

## 0.1.0 - 2020-08-16

### Added
- Added `Bridge`, `CallableResolver`, `ControllerInvoker` classes.
