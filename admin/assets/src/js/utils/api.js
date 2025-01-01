/* global MMEPSS */
export const fetchGetOptions = () => {
	return {
		headers: {
			"X-WP-Nonce": MMEPSS.NONCES.REST,
		},
	};
}

export const fetchPostOptions = ( postData ) => {
	return {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
			"X-WP-Nonce": MMEPSS.NONCES.REST,
		},
		body: JSON.stringify(postData),
	};
}

export const fetchPostFileUploadOptions = ( formData ) => {
	return {
		method: 'POST',
		headers: {
			'X-WP-Nonce': MMEPSS.NONCES.REST,
		},
		body: formData,
	}
}
