import axios, { AxiosResponse } from "axios";
import { Product, ProductState } from "../types/interface";

const state: ProductState = {
    product: [],
    data: {
        id: 0,
        name: "",
        image: "",
        price: "",
        sold: false
    }
};

const actions = {
    async listProduct({ commit }: any) {
        return await axios
            .get("/api/v1/product", {
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
                commit("listProduct", res.data);
            });
    }
};

const mutations = {
    listProduct: (results: ProductState, product: Product[]) =>
        (results.product = product)
};
const getters = {};
export default {
    state,
    actions,
    mutations,
    getters
};
