# Documentation and release policy

Documentation is part of every development stage and is updated in the same change set as the code.

## Documentation requirements

For every completed change or stage:

1. Update `README.md` when user-visible capabilities, installation or configuration change.
2. Update `CHANGELOG.md` with every added, changed, fixed, deprecated, security-related or compatibility change included in the version.
3. Update `docs/DEVELOPMENT_PLAN.md` with completed and remaining work.
4. Update the administration **Features** tab when the implemented feature set or version changes.
5. Update architecture and database documents whenever structures or design decisions change.
6. Add or revise installation, upgrade, configuration, usage and testing notes as applicable.
7. Keep Bulgarian and English administration and storefront language files synchronized.
8. Record compatibility differences between OpenCart 3 and OpenCart 4.
9. Document migration steps before changing existing database structures or setting keys.
10. Record known limitations and deferred work honestly.

No stage is considered complete until its documentation is current.

## Mandatory release workflow for every PR

Every development PR for ProBG Services must finish with a complete release cycle after the changes are validated:

1. Work is made on a feature/fix branch and committed with appropriate `feat:`, `fix:`, `docs:`, `refactor:` or other Conventional Commit-style messages.
2. The PR must contain all code and documentation for the version, including the complete `CHANGELOG.md` entry.
3. The version number must be updated consistently in all module metadata and user-visible version locations.
4. An installable OpenCart OCMOD package must be generated in `dist/` for that exact version.
5. `dist/SHA256SUMS` must be updated for the generated package.
6. The PR is merged automatically once the intended change set and required checks are complete.
7. A Git tag is created from the merged commit using the exact module version prefixed with `v`, for example `v1.0.1`.
8. A GitHub Release is created for that tag/version.
9. The release notes must contain **all changes included in that version** and must remain consistent with `CHANGELOG.md`.
10. The matching `dist/*.ocmod.zip` installation package must be attached to or otherwise made available through the release where tooling permits.

## Versioning

The project follows semantic versioning:

- patch: `1.0.0` → `1.0.1` for fixes and small compatible corrections;
- minor: `1.0.x` → `1.1.0` for backward-compatible features;
- major: `1.x.x` → `2.0.0` for incompatible changes.

Tag format is always `v<version>` (for example `v1.0.1`). The module metadata, package filename, changelog heading and GitHub Release version must refer to the same version.

## Release completeness rule

A PR is not considered fully delivered until all of the following are complete:

- PR merged;
- version bumped;
- complete `CHANGELOG.md` entry;
- installable versioned `.ocmod.zip` present in `dist/`;
- `SHA256SUMS` updated;
- `v<version>` tag created;
- GitHub Release created;
- release notes contain the complete change set for the version.
