-- Adds the per-post SEO fields to an existing `blog_posts` table
-- (schema.sql already includes these for fresh installs — only run this
-- against a database created before this migration existed).
--
-- Run once. If a column already exists you'll get a "Duplicate column
-- name" error for that line — safe to ignore and continue with the rest.

ALTER TABLE blog_posts ADD COLUMN cover_image_alt VARCHAR(200) NULL AFTER cover_image;
ALTER TABLE blog_posts ADD COLUMN meta_title VARCHAR(200) NULL AFTER cover_image_alt;
ALTER TABLE blog_posts ADD COLUMN meta_description VARCHAR(300) NULL AFTER meta_title;
ALTER TABLE blog_posts ADD COLUMN focus_keyword VARCHAR(100) NULL AFTER meta_description;
