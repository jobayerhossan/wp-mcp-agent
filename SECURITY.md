# Security policy

This development branch includes powerful remote WordPress editing functionality. Do not deploy it to an untrusted or public-facing instance before the MCP server's OAuth and per-site authorization are verified.

- Use HTTPS for both MCP and WordPress.
- Use unique randomly generated site secrets, stored privately.
- Never include site secrets or server registration credentials in Git history or client-side JavaScript.
- Keep MCP writes disabled by default; require explicit user confirmation before editing code or publishing content.
- Use a separate staging site with tested backup and rollback before production.
- Report vulnerabilities privately to the repository maintainer rather than disclosing exploitable details publicly.
