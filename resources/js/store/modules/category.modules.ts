import axios, { AxiosResponse } from "axios";
import { Category, CategoryState } from "../types/interface";

const state: CategoryState = {
    category: [],
    data: {
        id: 0,
        name: "",
        product: [],
        icon: ""
    }
};

const actions = {
    async listCategory({ commit }: any) {
        return await axios
            .get("/api/v1/product/category", {
                headers: {
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Methods": "GET",
                    "Access-Control-Allow-Origin": "*",
                    "Access-Control-Allow-Headers":
                        "Content-Type, Origin, Accepted, X-Requested-With"
                },
                timeout: 856000,
                responseType: "json",
                withCredentials: false,
                maxBodyLength: 2000,
                maxContentLength: 2000,
                maxRedirects: 5,
                validateStatus: (status: number) =>
                    status >= 200 && status < 300
            })
            .then((res: AxiosResponse<any>) => {
                commit("listCategory", res.data);
            });
    }
};
const mutations = {
    listCategory: (results: CategoryState, category: Category[]) =>
        (results.category = category)
};
const getters = {};
export default { state, actions, mutations, getters };
