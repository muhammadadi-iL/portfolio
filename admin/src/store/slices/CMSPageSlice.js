import {createAsyncThunk, createSlice} from '@reduxjs/toolkit';
import {HYDRATE} from 'next-redux-wrapper';
import {update, showByName, create} from '../../services/CMSPageService';

export const getPage = createAsyncThunk(
    'cms_page/get',
    async (name, thunkAPI) => {
        return await showByName(name)
    }
)

export const createPage = createAsyncThunk(
    'cms_page/create',
    async (payload, {getState}) => {
        return await create(payload)
    }
)

export const updatePage = createAsyncThunk(
    'cms_page/update',
    async (payload, thunkAPI) => {
        return await update(payload)
    }
)

const initialState = {
    success: false,
    loading: false,
    errors: null,
    page: null
};

export const CMSPageSlice = createSlice({
    name: 'cms_page',
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
                    ...action.payload.CMS,
                };
            },
        },
    },
    extraReducers: builder => {

        builder.addCase(getPage.pending, (state, action) => {
            state.loading = true
            state.errors = null
        })

        builder.addCase(getPage.fulfilled, (state, action) => {
            const {data, message} = action.payload
            state.page = data?.data ?? null

            state.loading = false
            state.errors = message
        })

        builder.addCase(createPage.pending, (state, action) => {
            state.loading = true
            state.success = false
            state.errors = null
        })

        builder.addCase(createPage.fulfilled, (state, action) => {
            const {data, message} = action.payload

            state.loading = false
            state.success = !message
            state.errors = message
        })

        builder.addCase(updatePage.pending, (state, action) => {
            state.loading = true
            state.success = false
            state.errors = null
        })
        builder.addCase(updatePage.fulfilled, (state, action) => {
            const {data, message} = action.payload

            state.loading = false
            state.success = !message
            state.errors = message
        })
    }
});

export const {setSuccess, setErrors, setEditorContent} = CMSPageSlice.actions;
export const page = (state) => state.cms_page.page;
export const loading = (state) => state.cms_page.loading;
export const errors = (state) => state.cms_page.errors;
export const success = (state) => state.cms_page.success;
export default CMSPageSlice.reducer;