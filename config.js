{
	/**
	 * 
	 */
	"scan_files": [
		// c-extractor adds to "symbole" look up table
		// c-extractor can fill up the following entries:

			// @type and @name (name is going to be the name from clangd)
			// -> no anonymous struct, anonymous structs will not work
		["napc.h", "c-extractor"],
		["napc.h", "doc-block-extractor", {
			"mapping": {
				// @module says which module is the entry belonging to
				"api.entry.module": "@module",
				// default action:
				// @type says what type an entry is:

					// @type fn -> docblock describes a function
					// @type type --> docblock describes a type
				"api.entry.type": "@type",
				// @name says the name of the entry
				// ^ means primary identifier
				"^api.entry.name": "@name",

				// for functions:

					// function consists of: <RETURN> <NAME><PARAMS>

				"function": {
					// name can be found in @param <NAME>
					"api.fn.parameter.name": "@param<split_space,0>",
					// description can be found in @param name <DESC>
					"api.fn.parameter.description": "@param<split_space,1>",
					// parameter type can be found else where
					// delegate parameter_type to c-extractor?
					"api.fn.parameter.type": "",
					// return description
					"api.fn.return.description": "@returns",
					// delegate return type to c-extractor
					"api.fn.return.type": ""
				},

				// for type alias (C only?):

				"type": {
					"api.type.alias.original_type": "#c-extractor",

				// for type enum

					"api.type.enum.name": "@enum<split_space,0>",
					"api.type.enum.description": "@enum<split_space,1>",
					"api.type.enum.value": ""
				}

				// type enum 

					// type struct (C only?)



			}
		}]
	],

	//
	{
		"api_version": 18112022,

		// all files resolved relatively to
		"document_root": "/home/marco/Desktop/files/",

		"modules": [{
			"fullname": "HRTimer",
			"display_label": "HRTimer",
			"brief": "High resolution timer.",

			"include_in_global_search": true,
			"highlight_in_code_examples": true,

			"icon": "/documentation/icon.svg",
			"about_document": "/documentation/core.md",
			"definitions": [{
				// name is the absolute name of a function/type
				"fullname": "napc_HRTimer_init",
				"display_label": "init",
				"type": "fn",
				"type_category": "function",

				"configuration": {
					"include_in_global_search": true,
					"highlight_in_code_examples": true
				},

				"type_specific_information": {
					"return": {
						"description": "Return description",
						"type": "return_type"
					},
					"params": [{
						"name": "name of param",
						"type": "type of param",
						"description": "description of param"
					}]
				},

				"general_information": {
					// changelog
					// version
					// author
					// origin
					// api stability
					// deprecated
					// notes
					// warnings
					// flags?
					// code examples
				}
			}]
		}],

		/*!
		 * 
		 * @module HRTimer
		 * @fullname napc_HRTimer_init
		 * @name init
		 * 
		 * @brief
		 * Brief description (one line)
		 * 
		 * @description
		 * This is a desription.
		 * 
		 */

		"documents": [{
			chapter: "Bla",
			entries: [[
				"title": "abcdef",
				"document": "/documentation/document1.md"
			]]
		}]
	}
}
