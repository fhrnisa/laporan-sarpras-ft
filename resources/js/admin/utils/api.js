export const api = {
    baseUrl: null,
    csrfToken: null,

    init(baseUrl, csrfToken) {
        this.baseUrl = baseUrl || '';
        this.csrfToken = csrfToken;
    },

    async request(endpoint, options = {}) {
        const cleanBaseUrl = this.baseUrl.endsWith('/') ? this.baseUrl.slice(0, -1) : this.baseUrl;
        const cleanEndpoint = endpoint.startsWith('/') ? endpoint : `/${endpoint}`;
        
        const url = `${cleanBaseUrl}${cleanEndpoint}`;

        const defaultOptions = {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken,
                'Accept': 'application/json'
            },
            ...options
        };

        const response = await fetch(url, defaultOptions);
        const result = await response.json();

        // JIKA RESPONSE GAGAL (status 400, 422, 500, dll)
        if (!response.ok) {
            // Lempar error agar bisa ditangkap oleh .catch() atau try-catch di caller
            const error = new Error(result.message || 'Terjadi kesalahan pada server');
            error.status = response.status;
            error.errors = result.errors; // Untuk validasi Laravel
            throw error;
        }

        return result;
    },

    get(endpoint) {
        return this.request(endpoint, { method: 'GET' });
    },

    post(endpoint, data) {
        return this.request(endpoint, {
            method: 'POST',
            body: JSON.stringify(data)
        });
    },

    put(endpoint, data) {
        return this.request(endpoint, {
            method: 'PUT',
            body: JSON.stringify(data)
        });
    },

    delete(endpoint) {
        return this.request(endpoint, { method: 'DELETE' });
    }
};