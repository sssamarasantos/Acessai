using Acessai.Data.Context;
using Acessai.Domain.Interfaces.Repository;
using Acessai.Domain.Models;
using Dapper;
using System.Data;

namespace Acessai.Data.Repository
{
    public class AlunoRepository : IAlunoRepository
    {
        private readonly DataContext _dataContext;

        public AlunoRepository(DataContext dataContext)
        {
            _dataContext = dataContext;
        }

        public async Task<Aluno> GetAlunoByIdAsync(long id)
        {
            var parameters = new DynamicParameters();
            parameters.Add("@ID", id);

            var query = "SELECT * FROM ALUNO WHERE ID = @ID";

            using var conn = _dataContext.CreateConnection();

            var t = await conn.QueryFirstOrDefaultAsync(query, parameters, commandType: CommandType.Text);

            return t;
        }
    }
}
