/*
Navicat SQLite Data Transfer

Source Server         : localhost_ac_db
Source Server Version : 30802
Source Host           : :0

Target Server Type    : SQLite
Target Server Version : 30802
File Encoding         : 65001

Date: 2017-03-27 11:29:54
*/

PRAGMA foreign_keys = OFF;

-- ----------------------------
-- Table structure for s_ac_data
-- ----------------------------
DROP TABLE IF EXISTS "main"."s_ac_data";
CREATE TABLE "s_ac_data" (
"id"  INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
"ac"  TEXT,
"title"  TEXT,
"contents"  BLOB,
CONSTRAINT "ac" UNIQUE ("ac")
);
