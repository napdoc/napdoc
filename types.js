{
	"type_specific_information": {

		"function": {
			"variadic": true|false,
			// variadic: 
			// @variadic Explain the variadic parameters here.

			"return": {
				"type": "return_type",
				"?description": "Return description"
			},

			"params": [{
				"name": "name of param",
				"type": "type of param",
				"?description": "description of param"
			}]
		},

		"type": {
			"kind": "alias|struct|enum|opaque",

			"kind_specific_information": {

				// for alias
				"alias_of": "original typename",

				// for struct
				"struct": {
					"fields": [{
						"name": "name_of_field",
						"type": "type_of_field",
						"?description": "description of field"
					}]
				},

				// for enums
				"enum": {
					"values": [{
						"name": "name_of_value",
						"?value": "value of enum value",
						"?description": "description of enum value"
					}]
				}

			}
		},


		"macro": {
			// params only set if macro is invokable
			"?params": [{
				"name": "name_of_param",
				// no "type" because macro
				"?description": "description of param"
			}]
		}

	}
}
