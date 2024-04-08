describe('template spec', () => {
  it('passes', () => {
    cy.visit('http://worktogether.fr/login')
  })

  it('can login', () => {
    cy.get('#username').type('admin@admin.com')
    cy.get('#password').type('vv83Bd^Jo!!6h^m%Lbn5')
    cy.get('[data-cy="login"]').click()
    cy.url().should('include', 'http://localhost:8000/');
  })
})