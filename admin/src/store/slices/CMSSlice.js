import {createAsyncThunk, createSlice} from '@reduxjs/toolkit';
import {HYDRATE} from 'next-redux-wrapper';
import {update, show} from '../../services/CMSPageService';

export const getCMS = createAsyncThunk(
    'cms/get',
    async ({id}, thunkAPI) => {
        return await show(id)
    }
)

export const updateCMS = createAsyncThunk(
    'cms/update',
    async (payload, thunkAPI) => {
        return await update(payload)
    }
)

const initialState = {
    success: false,
    loading: false,
    errors: null,
    cms: null
};

export const CMSSlice = createSlice({
    name: 'cms',
    initialState,
    reducers: {
        setSuccess: (state, {payload}) => {
            state.success = payload
        },
        setErrors: (state, {payload}) => {
            state.errors = payload
        },
        extraReducers: {
            [HYDRATE]: (state, action) => {
                return {
                    ...state,
                    ...action.payload.cms,
                };
            },
        },
    },
    extraReducers: builder => {

        builder.addCase(getCMS.pending, (state, action) => {
            state.loading = true
            state.errors = null
        })
        builder.addCase(getCMS.fulfilled, (state, action) => {
            const {data, message} = action.payload

            state.cms = data?.data ?? null

            state.loading = false
            state.errors = message
        })

        builder.addCase(updateCMS.pending, (state, action) => {
            state.loading = true
            state.success = false
            state.errors = null
        })
        builder.addCase(updateCMS.fulfilled, (state, action) => {
            const {data, message} = action.payload

            state.loading = false
            state.success = !message
            state.errors = message
        })
    }
});

export const {setSuccess, setErrors} = CMSSlice.actions;
export const cms = (state) => state.cms.cms;
export const loading = (state) => state.cms.loading;
export const total = (state) => state.cms.total;
export const totalPages = (state) => state.cms.totalPages;
export const errors = (state) => state.cms.errors;
export const success = (state) => state.cms.success;
export default CMSSlice.reducer;