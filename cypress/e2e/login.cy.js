describe('template spec', () => {
  beforeEach(()=> {
    cy.visit('http://localhost:8000');
  })

  it('can login', () => {
    cy.visit('http://localhost:8000/login');
    cy.get('#username').type('admin@admin.com')
    cy.get('#password').type('vv83Bd^Jo!!6h^m%Lbn5')
    cy.get('button[type="submit"]').click();
    cy.url().should('include', 'http://localhost:8000');
  })
})