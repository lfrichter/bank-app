
const request = require('supertest');
// const app = require("../app");
import app from '../services/Axios';

const userLogin = {
    email: 'fernando.richter@gmail.com',
    password: '12345678'
}

describe('Space test suite', () => {
    it('tests /destinations endpoints', async() => {
        // const response = await request(app)
        const response =  app.post("/login", userLogin, {
                    'Content-Type': 'application/json'
                });


        expect(response.statusCode).toBe(200);
        expect(response.body).toMatchObject({messages: Array, success: Boolean, token: String, User: Object});
    });

    // Insert other tests below this line

    // Insert other tests above this line
});



// import http from '../services/Axios';
// // import config from '../configApi';
// // import axios from 'axios'

// const supertest = require('supertest');

// const userLogin = {
//     email: 'fernando.richter@gmail.com',
//     password: '12345678'
// }

// test('GET /login', async () => {
//     axios.get.mockImplementation(() => Promise.resolve({ data: {...} }));
    // const response = await supertest(http)
    //     .post(`login`, {
    //             email: userLogin.email,
    //             password: userLogin.password,
    //         })

//     // expect(response.statusCode).toEqual(200);
//     // expect(response.body.valorDescontado).toEqual(5);
// })

// test('GET /login', async () => {
//     const response = await supertest(http)
//         .post(`login`, {
//                 email: userLogin.email,
//                 password: userLogin.password,
//             })

    // expect(response.statusCode).toEqual(200);
//     // expect(response.body.valorDescontado).toEqual(5);
// })
