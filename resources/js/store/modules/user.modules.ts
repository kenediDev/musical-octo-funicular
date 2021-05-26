import axios, { AxiosResponse } from "axios";
import { User, UserState, Message, Accounts } from "../types/interface";

const state: UserState = {
    message: {
        valid: 0,
        message: "",
        loading: false,
        soft_loading: ""
    },
    user: [],
    data: {
        id: 0,
        name: "",
        email: "",
        password: ""
    }
};

const actions = {
    async login({ commit }: any, args: User) {
        return await axios.post("/api/v1/auth", args, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With"
            },
            timeout: 865000,
            responseType: "json",
            withCredentials: false,
            maxBodyLength: 2000,
            maxContentLength: 2000,
            maxRedirects: 5,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    },
    async reset({ commit }: any, args: { token: string }) {
        return await axios.post("/api/v1/auth/reset/", args, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With"
            },
            timeout: 865000,
            responseType: "json",
            withCredentials: false,
            maxBodyLength: 2000,
            maxContentLength: 2000,
            maxRedirects: 5,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    },
    async me({ commit }: any) {
        return await axios
            .get("/api/v1/auth", {
                headers: {
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Methods": "GET",
                    "Access-Control-Allow-Origin": "*",
                    "Access-Control-Allow-Headers":
                        "Content-Type, Origin, Accepted, X-Requested-With",
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                },
                timeout: 865000,
                responseType: "json",
                withCredentials: true,
                maxBodyLength: 2000,
                maxContentLength: 2000,
                maxRedirects: 5,
                validateStatus: (status: number) =>
                    status >= 200 && status < 300
            })
            .then((res: AxiosResponse<any>) => {
                commit("me", res.data);
            })
            .catch(err => {
                localStorage.clear();
                window.location.reload();
            });
    },
    async uploadAvatar({ commit }: any, args: FormData) {
        return await axios.post("/api/v1/auth/update/avatar", args, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With",
                Authorization: `Bearer ${localStorage.getItem("token")}`
            },
            timeout: 865000,
            responseType: "json",
            withCredentials: true,
            maxBodyLength: 2000,
            maxContentLength: 2000,
            maxRedirects: 5,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    },
    async uploadBackground({ commit }: any, args: FormData) {
        return await axios.post("/api/v1/auth/update/background", args, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With",
                Authorization: `Bearer ${localStorage.getItem("token")}`
            },
            timeout: 865000,
            responseType: "json",
            withCredentials: true,
            maxBodyLength: 2000,
            maxContentLength: 2000,
            maxRedirects: 5,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    },
    async updateProfile({ commit }: any, args: Accounts) {
        return await axios.post("/api/v1/auth/update/profile", args, {
            headers: {
                "Content-Type": "application/json",
                "Access-Control-Allow-Methods": "POST",
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers":
                    "Content-Type, Origin, Accepted, X-Requested-With",
                Authorization: `Bearer ${localStorage.getItem("token")}`
            },
            timeout: 865000,
            responseType: "json",
            withCredentials: true,
            maxBodyLength: 2000,
            maxContentLength: 2000,
            maxRedirects: 5,
            validateStatus: (status: number) => status >= 200 && status < 300
        });
    }
};

const mutations = {
    message: (results: UserState, message: Message) =>
        (results.message = message),
    me: (results: UserState, user: User) => (results.data = user),
    avatar: (results: UserState, user: User) =>
        (results.data.accounts.avatar = user.accounts.avatar),
    background: (results: UserState, user: User) =>
        (results.data.accounts.background = user.accounts.background),
    profile: (results: UserState, user: User) =>
        (results.data.accounts = user.accounts)
};

const getters = {
    message: (results: UserState) => results.message,
    me: (results: UserState) => results.data,
};

export default {
    state,
    actions,
    mutations,
    getters
};
