# WordPress MCP Agent

A standalone WordPress plugin extracted from the original WordPress development agent, independently namespaced to avoid clashing with the source plugin.

> **Development build (v0.1.0). Do not install on production websites until the security review and end-to-end tests are complete.**

## Features

- Inspect WordPress, PHP, active theme, installed plugins and compatible page builders
- Search/read and revision-protected edit of **theme and plugin files**, including PHP syntax validation
- Encrypted backups and rollback of connector-created code changes
- Search, read, create, update, and roll back posts/pages/custom post types and Rank Math fields
- Upload media from supported ChatGPT attachments
- Elementor document create/read/update, targeted widget/container edits (add, update, delete, move), JSON validation/import/export, CSS regeneration and rollback
- Diagnostics for WordPress URLs
- HTTPS site registration using a site-specific HMAC credential

## Setup (development)

1. Download the branch as a ZIP and install it on a **disposable WordPress staging site**.
2. Activate **WordPress MCP Agent** and go to **Tools → WordPress MCP Agent**.
3. Deploy your own `wp-mcp-server` and configure its registration key and access controls.
4. Enter your own **HTTPS MCP server URL**, site alias and registration key. The plugin never defaults to the maintainer's hosted MCP.
5. Inspect the read-only tools first. Enable writes only after reviewing server permissions and creating site backups.

REST namespace: `/wp-json/wp-mcp/v1/`. Existing `jobayer-ai/v1` endpoints are deliberately not affected.

The plugin has independent class names, option names and a separate backup directory. The original plugin's GitHub updater is deliberately excluded.

## Safety

- Requires WordPress 6.4+ and PHP 8.0+.
- Never commit site secrets or registration keys.
- Site-to-server communication requires HTTPS; server-to-WordPress requests use timestamped HMAC signatures with replay protection.
- Theme/plugin source changes are powerful; the plugin refuses to patch its own files.
- Test in staging and keep a backup; changing a theme/plugin can break your website.

**This is a code-migration branch, not a security-certified release.**
