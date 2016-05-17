# Structure URL Matcher

Discrepencies between how Structure (buildwithstructure.com) and ExpressionEngine manage URLs can be annoying when it comes to importing data, doing redirects, letting clients loose on your site etc.

## What it does
* Identifies which Structure URLs do not match the default EE URL Title
* Allows you to update all Structure Page URLs to match the default EE URL Title
* Works in EE v2 - tested in v2.10.1+

## What it doesn't do
* Update default EE URL Titles to match Structure Page URLs. This is because EE URLs must be unique, whereas Structure URLs don't have to be.
* It doesn't work in EE v1
* It doesn't work in EE v3 (at time of writing Structure doesn't have a version for EE v3)

## Installation

* Copy the entire structure_url_matcher folder to your system/expressionengine/third_party folder.
* Go to Addons > Modules and install Structure URL Matcher