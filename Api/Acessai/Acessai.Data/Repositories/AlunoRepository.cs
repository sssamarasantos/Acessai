using Acessai.Data.Context;
using Acessai.Domain.Interfaces.Repository;
using Acessai.Domain.Models;
using Dommel;

namespace Acessai.Data.Repository
{
    public class AlunoRepository : IAlunoRepository
    {
        private readonly DataContext _dataContext;

        public AlunoRepository(DataContext dataContext)
        {
            _dataContext = dataContext;
        }

        public async Task<Aluno> GetAlunoByEmailAsync(string email)
        {
            using var conn = _dataContext.CreateConnection();

            return await conn.FirstOrDefaultAsync<Aluno>(x => x.Email == email);
        }

        public async Task<object> PostAlunoAsync(Aluno aluno)
        {
            using var conn = _dataContext.CreateConnection();

            var response = await conn.InsertAsync(aluno);
            return response;
        }
    }
}
