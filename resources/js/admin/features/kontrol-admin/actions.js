import { api } from '../../utils/api.js';
import { showToast } from '../../utils/toast.js';

const handleErrors = (errors) => {
    if (typeof errors === 'object') {
        let errorMessages = Object.values(errors).flat();
        showToast.error(errorMessages.join(', '));
    } else {
        showToast.error(errors || 'Terjadi kesalahan');
    }
    return false;
};

// Pastikan ada reloadCallback jika ingin refresh halaman otomatis
const reload = () => window.location.reload();

export const createAdmin = async (data) => {
    try {
            const response = await api.post('/admins', data);
            return response.data;
        } catch (error) {
            throw error;
        }
};

export const updateAdmin = async (id, data) => {
    try {
        const response = await api.put(`/admins/${id}`, data);
        return response.data;
    } catch (error) {
        throw error;
    }
};

export const deleteAdmin = async (id) => {
    try {
        const response = await api.delete(`/admins/${id}`);
        return response.data;
    } catch (error) {
        throw error;
    }
};

export const updateStatus = async (id, status) => {
    try {
        const response = await api.patch(`/admins/${id}/status`, { status });
        return response.data;
    } catch (error) {
        throw error;
    }
};