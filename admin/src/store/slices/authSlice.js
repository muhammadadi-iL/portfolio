import {createAsyncThunk, createSlice} from '@reduxjs/toolkit';
import {HYDRATE} from 'next-redux-wrapper';
import {login} from '../../services/authService';
import {useRouter} from "next/navigation";
import Cookie from "js-cookie";
import {useEffect} from "react";

export const loginUser = createAsyncThunk(
    'auth/loginUser',
    async ({ email, password }, thunkAPI) => {
        try {
            const response = await login(email, password);
            console.log('loginUser.response', response)
            return response.data; // Return user data or token here
        } catch (error) {
            return thunkAPI.rejectWithValue(error.response.data);
        }
    }
);


const initialState = {
    loading: false,
    errors: null,
    isAuth: false,
    user: null
};

export const authSlice = createSlice({
    name: 'auth',
    initialState,
    reducers: {
        setAuth(state, action) {
            state.isAuth = !!action.payload
            state.user = action.payload
        },
        logoutAuth(state, action) {
            state.isAuth = false
            state.user = null

            Cookie.remove('token')
        },

        extraReducers: {
            [HYDRATE]: (state, action) => {
                return {
                    ...state,
                    ...action.payload.auth,
                };
            },
        },
    },
    extraReducers: builder => {
        builder.addCase(loginUser.pending, (state, action) => {
            state.loading = true
            state.errors = null
        })
        builder.addCase(loginUser.fulfilled, (state, action) => {
            const {data, message} = action.payload

            if (data) {
                state.isAuth = !!data?.data
                state.user = data?.data
            }

            state.loading = false
            state.errors = message
        })
    }
});

export const {logoutAuth} = authSlice.actions;
export const isAuth = (state) => state.auth.isAuth;
export const user = (state) => state.auth.user;
export const errors = (state) => state.auth.errors;
export const loading = (state) => state.auth.loading;
export default authSlice.reducer;