const state = {
    // Modals
    drawer: 0,
    dialog: 0,
    dropdown: 0
};
const actions = {};
const mutations = {
    Dashboarddrawer: (results: any, args: number) => (results.drawer = args),
    dashboardDialog: (results: any, args: number) => (results.dialog = args),
    productDropdown: (results: any, args: number) => results.dropdown = args
};
const getters = {
    dashboard: (results: any) => results
};

export default {
    state,
    actions,
    mutations,
    getters
};
