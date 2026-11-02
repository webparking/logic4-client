# Security

## Reporting a vulnerability

Please do not open a public issue for security problems. Use GitHub's private vulnerability reporting on this repository: open the **Security** tab and choose **Report a vulnerability**. You will get a reply from the maintainers there.

Include the package version, the PHP version, and steps to reproduce.

## Supported versions

Security fixes are released for the latest 4.x version. Older major versions do not receive fixes; see [UPGRADE.md](UPGRADE.md) for moving forward.

## Handling credentials

- Never paste Logic4 credentials, access tokens or `Authorization` headers into issues, pull requests or logs. Redact them from Guzzle exception output before sharing it.
- Rotate the Logic4 API user's secret key and password immediately if they were exposed.
- The access token is cached under a key derived from the credentials. Use a cache store that other tenants of your application cannot read.
