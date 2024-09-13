import {apiUrl, errorResponse, exceptionResponse, getToken, successResponse, urlWithParams} from "./global";

export const create = async (payload) => {
    try {
        const form = new FormData()
        for (const payloadKey in payload) {
            if (payload[payloadKey] != null) {
                form.append(payloadKey, payload[payloadKey])
            }
        }

        const response = await fetch(`${apiUrl()}/events`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${getToken()}`
            },
            body: form,
        });

        const data = await response.json();

        if (data?.success === false) {
            return errorResponse(null, data?.message ?? 'Server Error')
        } else if (data?.statusCode === 400) {
            return errorResponse(null, data?.message ?? ['Server Error'])
        }
        return successResponse(data)
    } catch (e) {
        return exceptionResponse()
    }
}

export const update = async ({
                                 id,
    ...payload
                             }) => {
    try {
        const form = new FormData()
        for (const payloadKey in payload) {
            if (payload[payloadKey] != null) {
                form.append(payloadKey, payload[payloadKey])
            }
        }

        const response = await fetch(`${apiUrl()}/events/${id}`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${getToken()}`
            },
            body: form,
        });

        const data = await response.json();

        if (data?.success === false) {
            return errorResponse(null, data?.message ?? 'Server Error')
        } else if (data?.statusCode === 400) {
            return errorResponse(null, data?.message ?? ['Server Error'])
        }
        return successResponse(data)
    } catch (e) {
        return exceptionResponse()
    }
}

export const get = async (page = 1, limit = 15) => {
    try {
        const response = await fetch(urlWithParams(`${apiUrl()}/events`, {
            page, limit
        }), {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${getToken()}`
            }
        });

        const data = await response.json();

        if (data?.success === false) {
            return errorResponse(null, data?.message ?? 'Server Error')
        }

        return successResponse(data)
    } catch (e) {
        return exceptionResponse()
    }
}


export const show = async (id) => {
    try {
        const response = await fetch(`${apiUrl()}/events/${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${getToken()}`
            }
        });

        const data = await response.json();

        if (data?.success === false) {
            return errorResponse(null, data?.message ?? 'Server Error')
        }

        return successResponse(data)
    } catch (e) {
        return exceptionResponse()
    }
}

export const destroy = async ({
                                  id
                              }) => {
    try {
        const response = await fetch(`${apiUrl()}/events/${id}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${getToken()}`
            },
        });

        const data = await response.json();

        if (data?.success === false) {
            return errorResponse(null, data?.message ?? 'Server Error')
        } else if (data?.statusCode === 400) {
            return errorResponse(null, data?.message ?? ['Server Error'])
        }
        return successResponse(data)
    } catch (e) {
        return exceptionResponse()
    }
}