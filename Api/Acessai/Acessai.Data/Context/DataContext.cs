using Microsoft.Data.SqlClient;
using System.Data;
using System.Data.Common;

namespace Acessai.Data.Context
{
    public class DataContext
    {
        private readonly DbConnectionStringBuilder _connectionStringBuilder;

        public DataContext(DbConnectionStringBuilder connectionStringBuilder)
        {
            _connectionStringBuilder = connectionStringBuilder;
        }

        public IDbConnection CreateConnection()
        {
            return new SqlConnection(_connectionStringBuilder.ConnectionString);
        }
    }
}
