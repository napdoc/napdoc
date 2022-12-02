# tools/c-doc-block-extractor

This module extracts doc-block comments from C source files (`.c` and `.h`).

It can also parse doc-block comments from `.cpp` files, since it really only looks at comments that start with `/*!`.

## Required doc-block tags

The tags `@module` and `@fullname` are the only two tags that are required to be found in doc-block section.

Only one doc-block comment for a given `@fullname` may appear in the source file(s).

In a nutshell, the minimum is:

```c
/*!
 * @module Core
 * @fullname this_is_my_definition
 */
```

## Optional doc-block tags (SL = SingleLine, ML = MultiLine)

### Tags that can be specified only once

#### `@type <type>`, SL

`@type` denotes the type of a described definition.

It can be one of the following:

- `fn` describing a function
- `fn:variadic`, describing a variadic function
- `type:alias`, describing a `typedef`
- `type:enum`, describung an `enum` type
- `type:struct`, describing a `struct` type
- `type:opaque`, although this is not a valid C-type category, it denotes a type that should be treated as "opaque".
- `macro:var`, describing a macro variable
- `macro:fn`, describing a ''callable'' macro

Types can be inferred by other tools such as `napcdoc-c-clang-extractor`, but can be overriden with an explicit `@type` tag.

So you don't have to explicitly set `@type` if you don't want or need to.

#### @version `<version>`, SL
#### @brief, SL
#### @description, SL|ML
#### @deprecated `<message>`, SL|ML
#### @variadic [type=type:fn,type=type:fn:variadic] `<description>`, SL|ML
#### @api_stability `<stable|unstable|experimental>`, SL

### Tags that can be specified multiple times

#### @param [type=type:fn,type=type:fn:variadic] `<name> <description>`, SL|ML
#### @return [type=type:fn,type=type:fn:variadic] `<description>`, SL|ML
#### @enum [type=type:enum] `<name> <description>`, SL|ML
#### @field [type=type:struct] `<name> <description>`, SL|ML
#### @changelog `<version> <description>`, SL|ML
#### @warning `<text>`, SL|ML
#### @note `<text>`, SL|ML
#### @example `[title]\n<code>`, ML



-- validate @changelog
-- disallow @param ... <DESC> needs to use @variadic
-- add tests for @type "macro:fn" and @params
-- check that @name contains some of @fullname


-- unit test type:opaque invalid tags like @enum, @field etc.

-- add warning if different @module names found in a single file

-- maybe add pragmas like:

/*! $setGlobalModule Writer */
