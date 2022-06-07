describe('Authenticaation', () => {

    before(() => {
        // runs once before all tests in the block
    })

    beforeEach(() => {
        // runs before each test in the block
        // cy.visit('/')
    })

    afterEach(() => {
        // runs after each test in the block
    })

    after(() => {
        // runs once after all tests in the block
    })


    it('will redirect to login page when visitors accessing home', () => {
        cy.visit('/dashboard')

        cy.url().should('contains', '/login')
    })

    it('will register a user', () => {
        cy.visit('/register')

        cy.get('input[name=name]').type('admin')
        cy.get('input[name=email]').type('user' + new Date().valueOf() + '@mail.com')
        cy.get('input[name=password]').type('password')
        cy.get('input[name=password_confirmation]').type('password')

        cy.get('button').contains('Register').click()

        cy.url().should('contain', '/dashboard')
    })

    it('will log in a user', () => {
        cy.create('User').then(user => {
            cy.visit('/login');

            cy.get('input[name="email"]').type(user.email);
            cy.get('input[name="password"]').type('password');
            cy.get('button[type="submit"]').click();

            cy.url().should('contain', '/dashboard')
            cy.contains(user.name);
        });
    })

    it('maintains admin session', () => {
        cy.loginAs('admin@admin.com');

        cy.visit('/dashboard');

        cy.contains('Hello, admin');
        cy.contains('Dashboard');
        cy.contains('Users');
        cy.contains('Payments');
    })

    it('logout admin session', () => {
        cy.get('button').contains('admin').click()
        cy.get('a').contains('Log Out').click()
        cy.visit('/dashboard');
        cy.url().should('contain', '/login')
    })

    it('maintains user session', () => {
        cy.loginAs('user@user.com');

        cy.visit('/dashboard');

        cy.contains('Hello, user');
        cy.contains('Dashboard');
        cy.contains('Account Settings');
        cy.contains('My payments');
    })

    it('logout user session', () => {
        cy.get('button').contains('user').click()
        cy.get('a').contains('Log Out').click()
        cy.visit('/dashboard');
        cy.url().should('contain', '/login')
    })
})
