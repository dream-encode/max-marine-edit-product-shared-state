import {
	useEffect,
	useState
} from '@wordpress/element'

const useFieldWatcher = ( fields, fieldChangeCallback ) => {
	console.log({ fieldChangeCallback })
    const [ initialValues, setInitialValues ] = useState( {} )

	useEffect( () => {
		const listeners = []
		const initialValuesTemp = {}

		fields.forEach( ( { id } ) => {
			const field = document.getElementById( id )

			if ( ! field ) {
				return
			}

			// Save initial value
			initialValuesTemp[ id ] = field.value

			// Define the event listener
			const listener = () => {
				const currentValue = field.value
				const initialValue = initialValuesTemp[ id ]

				if ( currentValue !== initialValue ) {
					fieldChangeCallback( id, currentValue, initialValue )
				}
			}

			// Add listener
			field.addEventListener( 'change', listener )

			listeners.push( { field, listener } )
		} )

		// Set initial values
		setInitialValues( initialValuesTemp )

		console.log({ listeners })

		// Cleanup listeners on unmount
		return () => {
			listeners.forEach( ( { field, listener } ) => {
				field.removeEventListener( 'change', listener )
			} )
		}
	}, [ fields ] )

	return { initialValues }
}

export default useFieldWatcher